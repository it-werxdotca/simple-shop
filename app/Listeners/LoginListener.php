<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $prevCart = Cart::where("user_id",$event->user->id)->first();
        $cart = Cart::find(app("request")->session()->get("cart"));
        $cart->user_id = $event->user->id;
        $cart->save();

        if($prevCart){
            $cartItems = $cart->load("contents")->contents;
            $prevItems = $prevCart->load("contents")->contents;

            foreach ($cartItems as $cartItem){
                foreach ($prevItems as $prevItem){
                    if($prevItem->product_id == $cartItem->product_id){
                        $cartItem->quantity += $prevItem->quantity;
                    }
                }
            }

            CartItem::destroy($prevItems->pluck("id"));
            $prevCart->delete();
        }
    }
}
