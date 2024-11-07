<?php

namespace App\Http\Controllers;

use App\Models\User;
use Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    //
    //user dashboard
    public function dashboard()
    {
        $data = Product::get();
        $categories = Category::get();
        return view('user.dashboad', compact('data','categories'));
    }


    //user profile
    public function profile(){
        return view('user.profile');
    }


    //user profile edit
    public function editprofile(){
        return view('user.editprofile');
    }


    //user profile data update
    public function updateprofile(Request $request){

        $this->valiData($request);
        $id = $request->id;
        $data = $this->getUpdateData($request);
        if($request->hasFile('img')){

            //check old img
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete('public/'. $dbImage);
            }

            //store file

            $filename = uniqid() . $request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public',$filename);

            $data['image'] = $filename;

        }

        // update data
        User::where('id',$id)->update($data);
        return redirect()->route('user#profile');

    }


    // product detail
    public function pizzaDetail($id){

        $ratings = Rating::select('*', 'ratings.created_at as rcreated_at')->join('users','ratings.user_id','users.id');
        $ratings = $ratings->where('product_id',$id)->orderByDesc('rcreated_at')->get();
        $count = Product::where('id',$id)->first()->view_count + 1 ;
        Product::where('id',$id)->update(['view_count' => $count]);
        $detail = Product::where('id',$id)->first();

        $chanceOfRating = $ratings->where('user_id',Auth::user()->id)->all();
        $chanceOfRating = count($chanceOfRating);

        $avgStar = 0;
        if(count($ratings) != 0){
            $count = 0;
        for ($i=0; $i < count($ratings) ; $i++) {
            $count += $ratings[$i]->rating_count;
        }
        $avgStar = $count / count($ratings);
        };

        return view('user.pizzaDetail',compact('detail' ,'ratings' ,'avgStar','chanceOfRating'));

    }


    // validation
    private function valiData($data){
        Validator::make($data->all(), [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($data->id)],
            'phone' => ['required', Rule::unique('users')->ignore($data->id)],
            'address' => ['required'],
            'updated_at' => Carbon::now(),
        ])->validate();
    }

    // data
    private function getUpdateData($data){
        return[
            'name' => $data->name ,
            'email'=> $data->email,
            'phone' => $data->phone,
            'address' => $data->address,


        ];
    }
}

