<?php

namespace App\Services;


//? Classe de serviço Search, que utiliza a conexão.
class VtexSearchService {

    use VtexConnect;

    public function searchServiceVtex($url)
    {
    
        $result = $this->connectGet($url)->collect();

        return $result->filter(function($item){
            return $item['productId'] == "10015499";
        })->map(function($item){
            
            $item['productId'] = (int) $item['productId'];

            return [
                'productId' => $item['productId'],
                'productName' => $item['productName'],
                'brand' => $item['brand']
            ];
        })
        ->values();

        // dd($result);

    }

}