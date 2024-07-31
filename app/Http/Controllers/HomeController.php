<?php

namespace App\Http\Controllers;

use App\Actions\ViaCEP\Get;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        /** @var Illuminate\Http\Request $request */
        $request = request();

        return $request->has('search') && !empty($request->search) ?
            view('home', ['result' => Get::execute($request->search)]) :
            view('home');
    }
}
