<?php 

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

//? Classe de conexão, apenas conecta.
trait RedisService {

    public function setCacheTrait($value, $uid, $expiresAt)
    {

        Redis::set($uid, $value);

        Cache::put($uid, $value, $expiresAt);

        return Redis::get($uid);

    }

    public function getCacheById($uid)
    {
        $cache = Redis::get($uid);

        if($cache){
            return $cache;
        }

        return [
            'status' => 404,
            'msg' => 'nada encontrado'
        ];
    }

    
    
}