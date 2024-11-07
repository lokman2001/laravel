<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_list;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // ADMIN ORDER FUNCTION

    public function adminlist($status)
    {

        $orderList = Order::where('status',$status)->OrderBy('created_at','desc')->paginate(4);
        $Nstatus = $status;
        return view('admin.order.list',compact('orderList','status'));
    }


    public function adminListDetail($id){
        $orderLists = Order_list::select('*','products.name as product_name')
                                                ->join('products','order_lists.product_id','products.id')
                                                ->get();
        $order =Order::select('*','orders.id as order_id','users.id as user_id')
                                        ->join('users','orders.user_id','users.id')
                                        ->get();
        $orderdetail = $order->where('order_id', $id )->first();
        $ordercode = $orderdetail->order_code;
        $orderList = $orderLists->where('order_code',$ordercode)->all();

        return view('admin.order.detail',compact('orderList','orderdetail'));
    }

    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // USER ORDER FUNCTION

    public function userlist()
    {
        $orderList = Order::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(4);
        return view('user.order.list',compact('orderList'));
    }

    public function userlistDetail($id){
        $orderLists = Order_list::select('*')->join('products','order_lists.product_id','products.id')->get();
        $order = Order::where('id', $id )->first();
        $ordercode = $order->order_code;
        $orderList = $orderLists->where('order_code',$ordercode)->all();

        return view('user.order.detail',compact('orderList','order'));
    }
}
