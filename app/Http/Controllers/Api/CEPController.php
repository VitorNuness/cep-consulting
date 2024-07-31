<?php

namespace App\Http\Controllers\Api;

use App\Actions\ViaCEP\Get;
use App\Http\Controllers\Controller;

class CEPController extends Controller
{
    public function show(string $cep): \Illuminate\Http\JsonResponse
    {
        return response()->json(Get::execute($cep));
    }
}
