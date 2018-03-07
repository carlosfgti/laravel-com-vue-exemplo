<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'image'];



    /**
     * Filter Products
     *
     * @param  Array $data filtros
     * @param  int $totalPage itens por página
     *
     * @return \Illuminate\Http\Response
     */
    public function getResults(Array $data, int $totalPage)
    {
        // Se não existir filtro (name, description ou filter) retorna todos os resultados, paginados
    	if (!isset($data['name']) && !isset($data['description']) && !isset($data['filter']))
    		return $this->orderBy('id', 'DESC')->paginate($totalPage);

        // Traz os resultados filtrados
    	return $this->where(function ($query) use ($data) {
    				if (isset($data['name'])) {
    					$name = $data['name'];
    					$query->where('name', 'LIKE', "%{$name}%");
                    }
                    
                    if (isset($data['description'])) {
    					$description = $data['description'];
    					$query->where('description', 'LIKE', "%{$description}%");
    				}

    				if (isset($data['filter'])) {
                        $filter = $data['filter'];

                        $query->where('name', 'LIKE', "%{$filter}%")
                                ->orWhere('description', 'LIKE', "%{$filter}%");
                    }

                })
                ->orderBy('id', 'DESC')
                ->paginate($totalPage);// ->toSql();
    }
}
