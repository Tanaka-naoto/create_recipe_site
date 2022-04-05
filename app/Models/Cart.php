<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    public function stock()
    {
        return $this->belongsTo('\App\Models\Stock');
    }

    protected $fillable = [
        'stock_id', 'user_id', 'quantity'
    ];


    //商品表示のメソッド
    public function showCart()
   {
       $user_id = Auth::id();
       $data['my_carts'] = $this->where('user_id',$user_id)->get();

       $data['count']=0;
       $data['sum']=0;
       $data['count'] += $data['my_carts']->sum('quantity');

       foreach($data['my_carts'] as $my_cart){

        //    $data['sum'] += $my_cart->stock->fee;
           $data['sum'] += $my_cart->quantity * $my_cart->stock->fee;
       }
       return $data;
    }


   //商品表示追加のメソッド
   public function addCart($stock_id, $quantity)
   {
       $user_id = Auth::id();
       //もしテーブルにすでに同じユーザーIDとストックIDが存在している場合
        $cart_add_info = Cart::firstOrCreate(['stock_id' => $stock_id,'user_id' => $user_id]);





       if($cart_add_info->wasRecentlyCreated){
           $message = 'カートに追加しました';

       }
       else{

           $cart_add_info->quantity += $quantity;
           $message = 'すでにあります。';
       }

       return $message;
   }



   //商品削除のメソッド
   public function deletecart($stock_id)
   {
       $user_id = Auth::id();
       $delete = $this->where('user_id', $user_id)->where('stock_id',$stock_id)->delete();

       if($delete > 0){
           $message = '商品をかごから削除しました';
       }
       else{
           $message = '削除に失敗しました';
       }

       return $message;
   }

   //カートから商品を削除するメソッド
   public function checkoutCart()
   {
       $user_id = Auth::id();

       $checkout_items = $this->where('user_id', $user_id)->get();
       $this->where('user_id', $user_id)->delete();

       return $checkout_items;

   }


}
