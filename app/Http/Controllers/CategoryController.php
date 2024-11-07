<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{

    //list page

    public function list(){
        $key = request('key');
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->orderBy('id','desc')->paginate(4);

        return view('admin.category.list',compact('categories','key'));
    }
    // create Page
    public function createPage(){
        return view('admin.category.create');
    }

    //delete
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['delete'=>'remove Category successfully ']);

    }

    //edit category
    public function editCategoryPage($id){
        $data = Category::where('id',$id)->first();
       return view('admin.category.edit',compact('data'));

    }

    //update category
    public function updateCategory(request $request){
        $data = $request ;
        $id = $data->id;
        $this->valiData($data);
        Category::where('id',$id)->update([
            'name' => $data->name,
        ]);
        return redirect()->route('admin#category.list')->with(['success'=>'Update Category successfully ']);

    }

    // create category

    public function addIntoList(request $request){
        $data= $request;
        $this->valiData($data);
        $this->createCategoryToDB($data);
        $success = 'new category successfully added';
        return redirect()->route('admin#category.list')->with(['success'=>'Create Category successfully ']);


    }

    private function valiData($data){
        Validator::make($data->all(), [
            'name' => ['required', Rule::unique('categories')->ignore($data->id)],
        ])->validate();
    }

    private function createCategoryToDB($data){
        Category::create([
            'name' => $data ['name']
        ]);
    }


}
