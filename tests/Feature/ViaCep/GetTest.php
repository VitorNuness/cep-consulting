<?php

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
