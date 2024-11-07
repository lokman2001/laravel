<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class adminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    //admin profile
    public function profile()
    {
        return view('admin.profile');
    }

    // to edit profile page
    public function editprofile()
    {
        return view('admin.editprofile');
    }

    public function updateprofile(request $request)
    {
        $this->valiData($request);
        $id = $request->id;
        $data = $this->getUpdateData($request);
        if ($request->hasFile('img')) {

            //check old img
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            //store file

            $filename = uniqid() . $request->file('img')->getClientOriginalName();
            $request->file('img')->storeAs('public', $filename);

            $data['image'] = $filename;

        }

        // update data
        User::where('id', $id)->update($data);
        return redirect()->route('admin#profile');

    }

    public function adminList()
    {
        $data = User::where('role', 'admin')->get();
        return view('admin.adminList.adminList', compact('data'));
    }

    public function personalDetails($id)
    {
        $data = User::where('id',$id)->first();
        return view('admin.adminList.personalDetail', compact('data'));
    }

    public function roleChange()
    {
        $key = request('key');
        $data = User::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->where('role', 'user')->get();
        return view('admin.adminList.roleChange', compact('data', 'key'));
    }
    public function change($id)
    {
        User::where('id',$id)->update(['role' => 'admin']);
        return back();
    }

    public function remove($id)
    {
        User::where('id',$id)->update(['role' => 'user']);
        return back();
    }

    private function valiData($data)
    {
        Validator::make($data->all(), [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($data->id)],
            'phone' => ['required', Rule::unique('users')->ignore($data->id)],
            'address' => ['required'],
            'updated_at' => Carbon::now(),
        ])->validate();
    }

    private function getUpdateData($data)
    {
        return [
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,


        ];
    }
}
