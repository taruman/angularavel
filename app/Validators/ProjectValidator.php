<?php

namespace angularavel\Validators;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {
    
    protected $rules = [
        "owner_id" => "required|integer",
        "client_id" => "required|integer",
        "nome" => "required",
        "description" => "required",
        "progress" => "required",
        "status" => "required",
        "due_date" => "required"
    ];
    
}
