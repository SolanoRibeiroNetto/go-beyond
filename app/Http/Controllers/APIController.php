<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function showMessage()
    {
        $response = [
            'name' => "Leonardo",
            'lastname' => "Ribeiro",
            "age" => 26,
            "programming_language" => "PHP" 
        ];

        return Response($response, 418);
    }
    
    public function showAction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100',
            'idade' => 'required|int|max:120|min:1',
            'cep' => 'required|string|max:8',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return Response($validator->errors(), 406);
        }

        //? só chega aqui se estiver tudo ok.

        $request->nome = strtoupper($request->nome);
        
        $response = [
            'nome' => $request->nome,
            'idade' => $request->idade,
            'cep' => $request->cep,
            'email' => $request->email
        ];
    
        return Response($response, 200);

    }
}
