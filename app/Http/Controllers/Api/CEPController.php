<?php

namespace App\Http\Controllers\Api;

use App\Actions\ViaCEP\Get;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CEPController extends Controller
{
    public function show(string $cep)
    {
        return response()->json(Get::execute($cep));
    }
}
