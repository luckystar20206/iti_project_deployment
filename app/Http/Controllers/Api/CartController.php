<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use App\Models\User;

use function PHPUnit\Framework\at;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::all();

        return response()->json($carts, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cart = Cart::create([
            'user_id' => $request->user()->id
        ]);
        $cart->save();

        foreach ($request->cartItem as $product) {
            $selectedProduct = Product::where('id', $product['id'])->first();
            if ($selectedProduct) {
                $count = $product['product_quantity'];

                $cart->products()->attach($selectedProduct->id, ['product_quantity' => $count]);
            }
        }

        $cart->save();

        return Cart::where('id', $cart->id)->with('products')->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $cart = Cart::with('products')->where('user_id', $id)->first();
        // $product = Cart::with('products')->where('user_id', $request->user()->id)->get();
        // $cart = Cart::with('products')->where('user_id', $request->user()->id)->find($id);

        return response()->json($cart, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::with('products','user')->where('user_id', $request->id)->first();

        $cart->products()->detach();

        foreach ($request->cartItem as $product) {
            $selectedProduct = Product::where('id', $product['id'])->first();
            if ($selectedProduct) {
                $count = $product['product_quantity'];

                $cart->products()->attach($selectedProduct->id, ['product_quantity' => $count]);
            }
        }

        $cart->save();

        return Cart::where('id', $cart->id)->with('products')->first();
        // return $cart;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Cart::where('user_id', $id)->delete();
    }
}
