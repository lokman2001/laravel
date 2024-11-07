<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function list()
    {
        $key = request('key');
        $products = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('id', 'desc')->paginate(3);

        return view('admin.product.list', compact('products', 'key'));
    }

    public function detailPage($id)
    {
        $data = Product::select('*', 'products.id as product_id', 'products.name as product_name', 'categories.name as category_name')
            ->join('categories', 'products.category_id', 'categories.id')->get();
        $data = $data->where('product_id', $id)->first();

        return view('admin.product.detail', compact('data'));
    }

    public function createPage()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function create(request $request)
    {

        $this->validata($request);

        $imageFile = $request->file('image');
        $imageName = uniqid() . $request->file('image')->getClientOriginalName();

        $request->image = $imageName;
        $data = $this->makeData($request);

        $imageFile->storeAs('public', $imageName);
        Product::create($data);

        return redirect(route('admin#product.list'))->with(['success'=>'adding new product successfully ']);
    }

    public function delete($id)
    {

        $data = Product::where('id', $id)->delete();

        return back()->with(['delete'=>' remove product successfully ']);
    }

    public function editPage($id)
    {
        $categories = Category::all();
        $data = Product::where('id', $id)->first();

        return view('admin.product.edit', compact('categories', 'data'));
    }

    public function update(request $request)
    {
        $this->validata($request);
        $id = $request->id;
        $oldImage = Product::where('id', $id)->first();
        $oldImage = $oldImage->image;

        if ($request->hasFile('image')) {


            $newImage = uniqid() . $request->file('image')->getClientOriginalName();
            Storage::delete($oldImage);
            $request->file('image')->storeAs('public', $newImage);

            $request->image = $newImage;
            $data = $this->makeData($request);
            Product::where('id', $id)->update($data);

        } else {
            $request->image = $oldImage;
            $data = $this->makeData($request);
            Product::where('id', $id)->update($data);
        }

        return redirect(route('admin#product.list.detail', $id))->with(['success'=>'update product success ']);

    }

    private function validata($data)
    {
        Validator::make($data->all(), [

            'name' => ['required', rule::unique('products')->ignore($data->id)],
            'category' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['extensions:jpg,png']

        ])->validate();
    }


    private function makeData($data)
    {
        return ([
            'name' => $data->name,
            'category_id' => $data->category,
            'price' => $data->price,
            'description' => $data->description,
            'image' => $data->image
        ]);

    }

}
