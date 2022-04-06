<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('user')->get();

        if (!$request->user()) {
            return response()->json('You are not signed in', 404);
        }

        if ($request->user()->role == 'admin') {
            return response()->json($orders, 200);
        }

        $userOrders = Order::with('user')->get()->where("user_id", $request->user()->id);

        return response()->json($userOrders, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_cost = 0;

        // if ($request->user()->role == 'admin') {
        //     if (!$request->user_id) {
        //         return response()->json('Please Provide User', 404);
        //     }
        //     $order = Order::create([
        //         'user_id' => $request->user_id,
        //         'shipping_address' => $request->shipping_address,
        //     ]);
        //     $order->save();

        //     foreach ($request->products as $product) {
        //         $selectedProduct = Product::where('id', $product['id'])->first();
        //         if ($selectedProduct) {
        //             $count = $product['quantity'];
        //             $total_cost += $selectedProduct->price * $count;

        //             $order->products()->attach($selectedProduct->id, ['product_quantity' => $count]);
        //         }
        //     }
        //     $order->update([
        //         'total_cost' => $total_cost
        //     ]);

        //     $order->save();


        //     return Order::where('id', $order->id)->with('products')->first();
        // }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'shipping_address' => $request->user()->city,
            'status' => 'pending',
        ]);

        $order->save();

        foreach ($request->products as $product) {
            $selectedProduct = Product::where('id', $product['id'])->first();
            if ($selectedProduct) {
                $count = $product['pivot']['product_quantity'];
                $total_cost += $selectedProduct->price * $count;

                $order->products()->attach($selectedProduct->id, ['product_quantity' => $count]);
            }
        }
        $order->update([
            'total_cost' => $total_cost
        ]);

        $email = User::where('id', $request->user()->id)->get('email')->first();
        // $email = Table::select('name','surname')->where('id', 1)->get();

        $order->save();
        // $email = $order->user()->email;
        $email = User::where('id', $request->user()->id)->get('email')->first();
        Mail::to($email)->send(new OrderMail($order));
        // return new OrderMail($order);

        return [Order::where('id', $order->id)->with('products')->first(), new OrderMail($order)];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $order = Order::find($id);
        $user = Order::find($id)->user;
        $product = Order::find($id)->products;
        $productBrand = Brand::where('id', $product[0]->brand_id)->first();
        $productCategory = Category::where('id', $product[0]->brand_id)->first();

        return response()->json(array(['order' => $order,'user' => $user, 'products' => $product, 'brand' => $productBrand, 'category' => $productCategory]),200);
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

        $order = Order::find($id);

        // if (!$order) {
        //     return "No Order Found";
        // }

        // if (!$request->anyFilled($request->all()) == null) {
        //     return 'Please Enter A valid Value';
        // }

        //     if ($order)
        // ]);
        $order->status = $request->status;
        $order->save();
        return response()->json(array('order' => $order), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Response $response)
    {

        $order = Order::find($id);

        if (!$order) {

            return response()->json('No order found', 404);
        }

        if ($request->user()->role == 'admin') {

            return Order::destroy($id);
        }

        if ($request->user()->role !== "admin" && !Order::where("user_id", $request->user()->id)->get()->find($id)) {

            return "denied";
        }



        return Order::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($status)
    {
        return Order::where('status', 'like', '%' . $status . '%')->get();
    }
}
