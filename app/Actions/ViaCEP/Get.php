<?php

namespace App\Actions\ViaCEP;

use Illuminate\Support\Facades\Http;

class Get
{
    private function handle(string $cep): ?object
    {
        return cache($cep) ?: $this->__response($cep);
    }

    public static function execute(string $cep): ?object
    {
        return (new self())->handle($cep);
    }

    private function __response(string $cep): ?object
    {
        $response = Http::get(config('services.viacep.endpoint') . $cep . config('services.viacep.format'))->object();

        return object_get($response, 'erro') || empty($response) ? null : cache()->rememberForever($cep, fn () => $response);
    }
}
