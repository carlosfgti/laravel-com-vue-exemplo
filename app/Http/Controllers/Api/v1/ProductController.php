<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;
    private $totalPage = 4;
    
    /**
     * DI of \App\Models\Product
     *
     * @param  \App\Models\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response JSON
     */
    public function index(Request $request)
    {
        // Para testar o preloader no app client (opcional)
        sleep(2);
        $product = $this->product->getResults($request->all(), $this->totalPage);
        
        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ( !$product = $this->product->create($data) )
            return response()->json(['error' => 'error_insert'], 500);
        
        return response()->json($product, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( !$product = $this->product->find($id) )
           return response()->json(['error' => 'product_not_found'], 404);
        
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ( !$product = $this->product->find($id) )
           return response()->json(['error' => 'product_not_found'], 404);
        
        if ( !$product->update($data) )
            return response()->json(['error' => 'product_not_update'], 500);
        
        return response()->json($product);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( !$product = $this->product->find($id) )
           return response()->json(['error' => 'product_not_found'], 404);
        
        if ( !$product->delete() )
            return response()->json(['error' => 'product_not_delete'], 500);
        
        return response()->json($product);
    }
}
