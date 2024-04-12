<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\ProductStoreRequest;
use App\Http\Requests\Tenant\ProductUpdateRequest;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id=null)
    {
        if($id == null){
            $products = Products::latest()->paginate(100);
        }else{
            $products = Products::find($id);            
        }


        return response()->json([
            'status' => 'Success',
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {    
        
        if($request->hasFile('image')){
            $imageName = substr($request->image->getClientOriginalName(),0,-4).'-'.rand(1,9999).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }else{ $imageName = 'avatar.png';}

        $product = Products::create([
            'title' => $request->title,
            'slug' =>  Str::slug($request->title,'-'),
            'category' => $request->category,
            'price' => $request->price,
            'image' => $request->image,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully Created Product!',
            'data' => $product
        ]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $products = Products::findOrFail($id);

        if(!empty($request->image)){
            $old_image = public_path('images/' . $products->image);

            if(file_exists($old_image)) {
                unlink($old_image);
            }
            
            $imageName = substr($request->image->getClientOriginalName(),0,-4).'-'.rand(1,9999).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $products->image;
        }

        $product = Products::findOrFail($id)->update([
            'title' => $request->title,
            'slug' =>  Str::slug($request->title,'-'),
            'category' => $request->category,
            'price' => $request->price,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully Updated Product!',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        if($product->image != 'avatar.png'){
            $old_image = public_path('images/' . $product->image);
            if(file_exists($old_image)) {
                unlink($old_image);
            }
        }

        Products::findOrFail($id)->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully Deleted Product!',
            'data' => []
        ]);
    }
}
