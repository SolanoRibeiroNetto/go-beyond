<?php

namespace App\Services;

use App\Traits\ProdutosTrait;

//? Classe de serviço Search, que utiliza a conexão.
class VtexSearchService {

    use VtexConnect, ProdutosTrait;

    public function searchServiceVtex($url)
    {
    
        $result = $this->connectGet($url)->collect();

        // return $result->filter(function($item){
        //     return $item['productId'] == "10015499";
        // })->map(function($item){
            
        //     $item['productId'] = (int) $item['productId'];

        //     return [
        //         'productId' => $item['productId'],
        //         'productName' => $item['productName'],
        //         'brand' => $item['brand']
        //     ];
        // })
        // ->values();
        foreach($result as $item){

            $return = $this->CreateProdutosTrait($item);

            if($return['status'] == '500'){
                return $return;
            }

        }
        dd($result);

        return $result;
    }

}