<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductValidate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $product;
    private $totalPage = 4;
    private $path = 'products';
    
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
        // sleep(2);
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
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Define o nome para a imagem
            $name = kebab_case($request->name);
    
            // Recupera a extensão do arquivo
            $extension = $request->image->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            $data['image'] = $nameFile;
    
            // Faz o upload:
            $upload = $request->image->storeAs($this->path, $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
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

        // Verifica se informou a imagem para upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            if ($product->image != null) {
                // !importante: Deleta o arquivo de imagem que já existia
                if (Storage::exists("{$this->path}/{$product->image}"))
                    Storage::delete("{$this->path}/{$product->image}");
            }

            // Define o nome para a imagem
            $name = kebab_case($request->name);
        
            // Recupera a extensão do arquivo
            $extension = $request->image->extension();
    
            // Define finalmente o nome
            $product->image = "{$name}.{$extension}";

            $data['image'] = $product->image;
    
            // Faz o upload:
            $upload = $request->image->storeAs($this->path, $product->image);
    
            // Verifica se NÃO deu certo o upload
            if ( !$upload )
                return response()->json(['error' => 'fail_upload'], 500);
        } else {
            unset($data['image']);
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

        // !importante: Deleta o arquivo de imagem que já existia
        if ($product->image != null) {
            if (Storage::exists("{$this->path}/{$product->image}"))
                Storage::delete("{$this->path}/{$product->image}");
        }
        
        if ( !$product->delete() )
            return response()->json(['error' => 'product_not_delete'], 500);
        
        return response()->json($product, 204);
    }
}
