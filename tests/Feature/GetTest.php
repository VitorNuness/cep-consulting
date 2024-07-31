<?php

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

it('should can return a cep information', function () {
    $data = App\Actions\ViaCEP\Get::execute('01001000');

    expect($data)
        ->toHaveProperties(['cep', 'logradouro', 'complemento', 'unidade', 'bairro', 'localidade', 'uf']);
});

it('should return erro given a inexistent cep', function () {
    $data = App\Actions\ViaCEP\Get::execute('01000100');

    expect($data)
        ->toBeNull();
});

it('should dont return when given a invalid cep', function () {
    $data = App\Actions\ViaCEP\Get::execute('100');

    expect($data)
        ->toBeNull();
});

it('should access home page', function () {
    get(route('home'))
        ->assertSuccessful();
});

it('should can see a cep information on search result', function () {
    get(route('home', [
        'search' => '01001000',
    ]))->assertSee(["01001-000", "Praça da Sé", "lado ímpar",  "", "Sé", "São Paulo", "SP",]);
});

it('should dont see a cep information on search result', function () {
    get(route('home', [
        'search' => '01000100',
    ]))->assertSee('Don\'t found this CEP.');
});

it('should access api cep route', function () {
    getJson(route('api.cep', '01001000'))
        ->assertSuccessful();
});

it('should the api return a cep information', function () {
    getJson(route('api.cep', '01001000'))
        ->assertJson([
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'complemento' => 'lado ímpar',
            'unidade' => '',
            'bairro' => 'Sé',
            'localidade' => 'São Paulo',
            'uf' => 'SP',
        ]);
});

it('should the api dont return a cep information', function () {
    getJson(route('api.cep', '01000100'))
        ->assertJson([]);
});
