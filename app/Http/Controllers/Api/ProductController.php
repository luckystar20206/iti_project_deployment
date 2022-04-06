<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Review;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

// use App\Http\Requests\StoreProductRequest;
// use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with("brand","category")->get();
        $result = [];
        // dd($products);
        foreach($products as $product){
            $product["isWished"]=$product->isWished();
            
        }

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
 
        $product = new Product;

        if($request->hasFile('image')){
            $compliteFileName = $request->file('image')->getClientOriginalName();
            $filaNameOnly = pathinfo($compliteFileName , PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $comPic = str_replace(' ' , '_' , $filaNameOnly).'-'.rand() . '_'.time(). '.'.$extension;
            $path = $request->file('image')->storeAs('public/products' , $comPic);
            $product->image=$comPic;
        }
        $category= $request->category;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount=$request->discount;
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        // $product->average_rate= 0;
        
        $product->save();
        if($product->save()){
            return response()->json($product, 201);
        }else {
            return ['status' => false, 'message' => 'Couldnt Save Image'];
        }

     }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
     public function show($id)
    {
        if(
        $wishproduct= Product::with("brand") 
        ->find($id)){
            $wishproduct["isBought"]=$wishproduct->isBought();
            $wishproduct["isWished"]=$wishproduct->isWished();
            $wishproduct["isRated"]=$wishproduct->isRated();
        return response()->json($wishproduct); 
    }else{
            $product=Product::with("brand")->find($id);
            $product["isWished"]=$product->isWished();
            $product["isBought"]=$product->isBought();
            $product["isRated"]=$product->isRated();
            return response()->json($product); 
        // return "Not in Wishlist";
    };
}
        // Check if Product in WishList
    //     public function checkProduct($id){
    //     if(
    //           Product::with("brand")->where(function($query) { 
    //             $query->has('wishedProduct');
    //         })->find($id)){
    //         return true; 
    //     }else{
    //             return false; 
    // }
    // }
    public function showRealted($id){
        $product=Product::with("brand")->find($id);
        $cat_id = $product->category_id;
        $related_products=Product::where('category_id',$cat_id)->Limit(10)->get();
        return response()->json($related_products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
      */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id){
        try{
            $user = auth()->userOrFail();
        }catch(UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        }
        if($user->role =="admin"){
            $product = Product::find($id);
            if($product){
                $product->update($request->all());
                $response['status'] = 1;
                $response['message'] = 'Product updated successfully';
                $response['code'] = 200;
            }
            else{
                $response['status'] = 0;
                $response['message'] = 'Product not found';
                $response['code'] = 404;
            }
        }
        else{
            return "You Are Not Admin";
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = auth()->userOrFail();
        }catch(UserNotDefinedException $e){
            return response()->json(['error' => $e->getMessage()]);
        }
        if($user->role =="admin"){

        $product = Product::destroy($id);
        return $product;
        }
        else{
            return "You Are Not Admin";
        }
    }
    public function search($name)
    {
    return Product::where('name', 'like', '%'.$name.'%')->get();
    }

    public function rating()
    {
    $products= Product::orderBy('average_rate','desc')->take(3)->get();
    return $products;
    }

}
