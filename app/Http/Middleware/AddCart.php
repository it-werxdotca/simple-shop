<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Support\Facades\Auth;

class AddCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has("cart")) {
            if(Auth::check()){
                session()->put("cart"
                    , Cart::where("user_id",Auth::user()->id)
                        ->first()->id
                );
            }
            else{
                $cart = Cart::create([]);
                session()->put("cart", $cart->id);
            }
        }

        return $next($request);
    }
}
