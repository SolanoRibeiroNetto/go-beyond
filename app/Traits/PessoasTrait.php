<?php

namespace App\Traits;

use App\Models\Pessoas;
use App\Services\RedisService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ListagemPessoasResource;

trait PessoasTrait
{

    use RedisService;

    public function CreatePessoasTrait(object $request) : array
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'age' => 'required|int|max:120|min:1',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
                ];
        }

        $request->name = strtoupper($request->name);
     
        try {
            $pessoa = Pessoas::create([
                'nome' => $request->name,
                'idade' => $request->age,
                'email' => $request->email
            ]);
        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $pessoa
        ];
    }

    public function ListagemDePessoasTrait(object $request) : array
    {

        $expiresAt = now()->addMinutes(1);

        if(isset($request->filter_age)){
            $list = Pessoas::where(['idade' => $request->filter_age])->get();
        } else {

            // $this->setCacheTrait($value, "_pessoas_listagem");

            $cache = $this->getCacheById("_pessoas_listagem");
            
            if(is_array($cache)){
                if($cache['status'] == 404){
                    $list = Pessoas::all()->toArray();
                    $this->setCacheTrait(json_encode($list), "_pessoas_listagem", $expiresAt);
                } else {
                    $list = $cache;
                }
            } else {
                $list = json_decode($cache, true);
            }





            // $list = Pessoas::all();
        }
        
        return [ 
            'status' => 200,
            'data' => ListagemPessoasResource::collection($list)->values(), 
        ];
    }

    public function ListagemDePessoasByIdTrait(int $id) : array
    {
        $pessoa = Pessoas::where(['id' => $id])->get();
        
        return [ 
            'status' => 200,
            'data' => ListagemPessoasResource::collection($pessoa)->values(), 
        ];
    }

    public function UpdatePessoasTrait(object $request, int $id) : array
    {

        $fieldsValidator = array_merge($request->all(), ['id' => $id]);

        $validator = Validator::make($fieldsValidator, [
            'id' => 'required|int',
            'name' => 'required|string|max:120',
            'age' => 'required|int|max:120|min:1',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
                ];
        }

        try {

            $pessoa = Pessoas::find($id);

            $pessoa->nome = $request->name;
            $pessoa->idade = $request->age;
            $pessoa->email = $request->email;
    
            $pessoa->save();

        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $pessoa
        ];
        
    }

    public function DeletePessoasTrait(int $id) : array 
    {
        $fieldsValidator = ['id' => $id];

        $validator = Validator::make($fieldsValidator, [
            'id' => 'required|int'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
                ];
        }

        $pessoa = Pessoas::where('id', $id)->first();

        if(is_null($pessoa)) {
            return [
                'status' => 200,
                'msg' => 'registro já apagado.'
            ];
        }

        try {
            
            $pessoa->delete();

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }
        
        return [
            'status' => 200,
            'msg' => 'registro apagado.'
        ];

    }

    //! Métodos especiais para Commands.

    public function CommandMethodCleanTablePessoas() : void 
    {
        Pessoas::truncate();
    }

    public function CommandMethodCreateRegistersFakerPessoas(int $quantity) : void
    {
        \App\Models\Pessoas::factory($quantity)->create();
    }
}