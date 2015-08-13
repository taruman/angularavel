<?php

namespace angularavel\Validators;
use \Prettus\Validator\LaravelValidator;

class ClienteValidator extends LaravelValidator {
    
    protected $rules = [
        "nome" => "required|max:255",
        "responsavel" => "required|max:255",
        "email" => "required|email",
        "telefone" => "required",
        "endereco" => "required"
    ];
    
}
