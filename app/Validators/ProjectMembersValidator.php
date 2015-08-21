<?php

namespace angularavel\Validators;
use \Prettus\Validator\LaravelValidator;

class ProjectMembersValidator extends LaravelValidator {
    
    protected $rules = [
        "project_id" => "required|integer",
        "user_id" => "required|integer"
    ];
    
}
