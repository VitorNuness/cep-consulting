<?php

namespace App\Actions\ViaCEP;

use Illuminate\Support\Facades\Http;

class Get
{
    private function handle(string $cep): ?object
    {
        $response = Http::get(config('services.viacep.endpoint') . $cep . config('services.viacep.format'))->object();
        if (object_get($response, 'erro')) {
            return null;
        }
        return $response;
    }

    public static function execute(string $cep): ?object
    {
        return (new self())->handle($cep);
    }
}
