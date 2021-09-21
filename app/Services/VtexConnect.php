<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;


//? Classe de conexão, apenas conecta.
trait VtexConnect {
    
    public function connectGet($url)
    {        
        $result = Http::accept('application/json')->get($url);
        return $result;
    }

}


