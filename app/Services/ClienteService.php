<?php

namespace angularavel\Services;
use angularavel\Repositories\ClienteRepository;
use \angularavel\Validators\ClienteValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ClienteService {
    private $repository;
    private $validator;
    
    public function __construct(ClienteRepository $repository, ClienteValidator $validator) {
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
