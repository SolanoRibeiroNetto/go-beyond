<?php

namespace App\Http\Controllers;

use App\Traits\PessoasTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class APIPessoasController extends Controller
{

    use PessoasTrait;

    protected $list = [];

    //* Route de GET Listagem
    public function listagemDePessoas(Request $request)
    {
        //? Método refatorado para a Trait PessoasTrait.      
        $result = $this->ListagemDePessoasTrait($request);
        return Response($result, $result['status']);
    }

     //* Route de GET Listagem By Id
     public function listagemDePessoasById(int $id)
     {
         //? Método refatorado para a Trait PessoasTrait.      
         $result = $this->ListagemDePessoasByIdTrait($id);
         return Response($result, $result['status']);
     }

    //* Route de POST Cadasrtro
    public function cadastraPessoa(Request $request)
    {
        //? Método refatorado para a Trait PessoasTrait.       
        $result = $this->CreatePessoasTrait($request);
        return Response($result, $result['status']);
    }

    //* Route de PUT Atualizacao
    public function atualizarPessoa(Request $request, int $id)
    {
        //? Método refatorado para a Trait PessoasTrait.       
        $result = $this->UpdatePessoasTrait($request, $id);
        return Response($result, $result['status']);
    }

    //* Route de DELETE Atualizacao
    public function deletePessoa(int $id)
    {
        //? Método refatorado para a Trait PessoasTrait.       
        $result = $this->DeletePessoasTrait($id);
        return Response($result, $result['status']);
    }

    public function test()
    {
        $uid = uniqid();

        Redis::set($uid, "Leonardo");

        $expiresAt = now()->addMinutes(1);

        Cache::put($uid, "Leonardo", $expiresAt); 

        return Redis::get($uid);
    }

}
