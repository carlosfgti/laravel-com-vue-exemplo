<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductValidate;

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
     * @param  \App\Http\Requests\StoreUpdateProductValidate $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductValidate $request)
    {
        $data = $request->all();

        // Verifica se informou a imagem para upload
        if ($request->has('image')) {
            $name = kebab_case($request->name);
    
            // Recupera a extensão do arquivo
            $image = $request->get('image');
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            // Define finalmente o nome + extensão
            $nameFile = "{$name}.{$extension}";

            // Atualiza no array $data para atualizar no banco
            $data['image'] = $nameFile;

            // Faz o upload:
            //$upload = $request->image->storeAs('products', $nameFile);
            $upload = \Image::make($image)->save(public_path('storage/products/').$nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/products/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload
            if ( !$upload )
                return response()->json(['error' => 'fail_upload'], 500);
        }

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
     * @param  \App\Http\Requests\StoreUpdateProductValidate $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductValidate $request, $id)
    {
        $data = $request->all();

        if ( !$product = $this->product->find($id) )
           return response()->json(['error' => 'product_not_found'], 404);

        // Faz o upload da nova imagem, caso informado
        if ($request->has('image') && $product->image != $request->image) {
            // Recupera a extensão do arquivo
            $image = $request->get('image');
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            // Define finalmente o nome
            $nameFile = "{$task->name}.{$extension}";

            $data['image'] = $nameFile;

            // Faz o upload: //$upload = $request->image->storeAs('products', $nameFile);
            $upload = \Image::make($image)->save(public_path('storage/products/').$nameFile);

            // Verifica se NÃO deu certo o upload
            if ( !$upload )
                return response()->json(['error' => 'fail_upload'], 500);
        }
        
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
