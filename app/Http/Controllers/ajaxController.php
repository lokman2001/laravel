<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Order_list;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class ajaxController extends Controller
{
    public function badgeData(){
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $cartListBadge = count($cart);

        return response()->json([
            'cartListBadge' => $cartListBadge
        ]);

    }
    //
    public function pizzaData(Request $request)
    {

        $sort = $request->sort;

        $response = Product::orderBy("id", $sort)->get();

        return $response;

    }

    public function pizzaDataFilterByCategory(Request $request)
    {
        $sort = $request->sort;
        $id = $request->category;
        if ($id == '0') {
            $response = Product::orderBy("id", $sort)->get();
        } else {
            $response = Product::where('category_id', $id)->orderBy("id", $sort)->get();
        }

        return $response;

    }

    public function orderlist(Request $request)
    {
        $total = '0';
        $orderCode = '';
        foreach ($request->all() as $item) {
            Order_list::create($item);
            $total += $item['total'];
            $orderCode = $item['order_code'];
        }

        Cart::where('user_id', auth::user()->id)->delete();

        Order::create([
            'user_id' => auth::user()->id,
            'order_code' => $orderCode,
            'total_price' => $total,

        ]);

        return response()->json([
            'status' => 'success',
        ]);

    }

    public function clearCartList()
    {
        Cart::where("user_id", auth::user()->id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function statusChange(request $request)
    {
        $status = $request->status;
        $ordercode = $request->order_code;
        Order::where('order_code', $ordercode )->update(['status' => $status]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function rating(request $request){
        Rating::create([

            'rating_status' => $request->rating ,
            'user_id' => Auth::user()->id ,
            'product_id' => $request->product_id ,
            'rating_count' => $request->rating ,
            'message' => $request->message ,

        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function Suggestion(request $request)
    {
        $message = $request->message;
        Contact::create([

            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'message' => $message,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Thanks For Suggestion'
        ]);
    }

}
