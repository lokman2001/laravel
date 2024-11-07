<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    //
    public function List(){
        $userId = Auth::user()->id;
        $carts = Cart::select('*')
                            ->join('products','carts.product_id','products.id');
        $cartlist = $carts->where('user_id', $userId)->get();
        $totalamount = 0;
        for ($i=0; $i < count($cartlist) ; $i++) {
            $totalamount += $cartlist[$i]->price * $cartlist[$i]->qty;
        }

        return view('user.cart.list', compact('cartlist','totalamount'));

    }

    public function addtoCart(Request $request){
        $data = $this->makeData($request);
        Cart::create($data);

        return redirect(route('user#dashboard'));
    }

    private function makeData($data){
        return ([
            'user_id' => $data->user_id ,
            'product_id' => $data->product_id,
            'qty' => $data->qty,
        ]);
    }
}
