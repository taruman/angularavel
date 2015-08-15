<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectRepository;
use \angularavel\Validators\ProjectValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService {
    private $repository;
    private $validator;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function create(array $data) {
        
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $exc) {
            return [
              "error" => true,
              "message" => $exc->getMessageBag()
            ];
        }

    }
    
    function update(array $data, $id) {
        
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $exc) {
            return [
              "error" => true,
              "message" => $exc->getMessageBag()
            ];
        }      
              
    }
}
