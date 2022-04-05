<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail; //追記
use App\Mail\Thanks;//追記

class ShopController extends Controller
{
    public function index()
   {
       $stocks = Stock::Paginate(6); //Eloquantで検索
       return view('shop',compact('stocks')); //追記変更
   }


   public function myCart(Cart $cart)
   {
        $data = $cart->showCart();
        return view('mycarts',$data);
   }


   public function addMycart(Request $request, Cart $cart)
   {

    $stock_id = $request->stock_id;
    $quantity = (int)$request->quantity;

    // dd($quantity);


    $message = $cart->addCart($stock_id, $quantity);


    //追加後の情報を取得
    $data = $cart->showCart();

    return view('mycarts',$data); //追記

   }

   public function deleteCart(Request $request,Cart $cart) {

     //カートから削除の処理
     $stock_id=$request->stock_id;
     $message = $cart->deleteCart($stock_id);

     //追加後の情報を取得
     $data = $cart->showCart();

     return view('mycarts',$data)->with('message',$message);//追記

   }

   public function checkout(Cart $cart) {

    $user = Auth::user();
    $mail_data['user']=$user->name; //追記
    $mail_data['checkout_items']=$cart->checkoutCart(); //編集
    Mail::to($user->email)->send(new Thanks($mail_data));//編集
    return view('checkout');
   }
}
