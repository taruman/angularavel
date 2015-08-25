<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectRepository;
use angularavel\Repositories\ProjectMembersRepository;
use \angularavel\Validators\ProjectValidator;
use \angularavel\Validators\ProjectMembersValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectService {
    private $repository;
    private $members_repository;
    private $validator;
    private $members_validator;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMembersRepository $members_repository, ProjectMembersValidator $members_validator) {
        $this->repository = $repository;
        $this->members_repository = $members_repository;
        $this->validator = $validator;
        $this->members_validator = $members_validator;
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
    
    function addMember(array $data) {   
        
        try {
            $this->members_validator->with($data)->passesOrFail();
            return $this->members_repository->create($data);
        } catch (ValidatorException $exc) {
            return [
              "error" => true,
              "message" => $exc->getMessageBag()
            ];
        }
        
    }
    
    function isMember($id, $userId) {
        
        $member = $this->members_repository->findWhere([
            'user_id'=>$userId,
            'project_id'=>$id
        ]); 
        
        return $member;
              
    }    
}
