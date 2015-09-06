<?php

namespace angularavel\Validators;
use \Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {
    
    protected $rules = [
        "project_id" => "required|integer",
        "name" => "required",
        "description" => "required",
        "extension" => "required",
        "file" => "required"
    ];
    
}
