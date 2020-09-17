<?php

use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia\Inertia::render("StoreMain");
})->name("main");

Route::get("/list",function(){
    $products = Product::with("category.parent")->paginate(10);
    $categories = Category::with("children")
        ->whereNull("parent_id")
        ->get();
    return Inertia\Inertia::render("List",
        [
            "products" => $products,
            "categories" => $categories
        ]
    );
});

Route::get("/cart",function(){
    return Cart::find(session()->get("cart"))->contents;
});

Route::post("/cart",function (Request $request){
    $cart = Cart::find(session()->get("cart"));
    CartItem::destroy(
        $cart->contents
            ->pluck("id")
    );

    foreach ($request->items as $item){
        if($item["quantity"] > 0){
            CartItem::create(
                [
                    "product_id" => $item["product_id"],
                    "cart_id" => $cart->id,
                    "quantity" => $item["quantity"],
                ]
            );
        }
    }

    $cart->load("contents");

    return $cart->contents;
});

Route::get("/basket",function(){
    return Inertia\Inertia::render("Basket");
});

Route::get("/checkout",function(){
    $products = Cart::find(session()
        ->get("cart"))
        ->contents()
        ->with("product")
        ->get();
    return Inertia\Inertia::render("Checkout",["products" => $products]);
});

Route::post("/checkout",function(Request $request){
    $order = Order::create($request->order);

    if(Auth::check()){
        $order->user_id = Auth::user()->id;
        $order->save();
    }

    $items = Cart::find(session()->get("cart"))
        ->contents()
        ->get();

    $items->each(function($item) use($order) {
        OrderItem::create(
            [
                "order_id" => $order->id,
                "product_id" => $item->product_id,
                "price" => $item->product->price,
                "quantity" => $item->quantity
            ]
        );
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get("/{product:slug}",function(Product $product){
    $product->load("pictures");
    $product->load("description");
    $product->load("category.parent");
    $product->load("reviews");

    $related = Product::all()->random(4);
    $reviewData = $product->reviewData();

    return Inertia\Inertia::render("Product",
        [
            "product" => $product,
            "related" => $related,
            "reviewData" => $reviewData
        ]
    );
});
