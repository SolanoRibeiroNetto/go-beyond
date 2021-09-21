<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;
use Illuminate\Http\Request;

class ServicesAPIVtexController extends Controller
{

    protected $endpointSearch;

    public function __construct()
    {
        //? Controller API VTEX que utiliza o Service Search, podendo utilizar diversos Services Diferentes.
        $this->endpointSearch = new VtexSearchService();  
    }
    

    public function listagemSearchVtex()
    {

        $result = $this->endpointSearch->searchServiceVtex("https://loja.chillibeans.com.br/api/catalog_system/pub/products/search?Rayban");

        return $result;
    }

}
