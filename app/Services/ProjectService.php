<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectRepository;
use angularavel\Repositories\ProjectMembersRepository;
use \angularavel\Validators\ProjectValidator;
use \angularavel\Validators\ProjectMembersValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService {
    private $repository;
    private $members_repository;
    private $validator;
    private $members_validator;
    private $filesystem;
    private $storage;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMembersRepository $members_repository, ProjectMembersValidator $members_validator, Filesystem $filesystem, Storage $storage) {
        $this->repository = $repository;
        $this->members_repository = $members_repository;
        $this->validator = $validator;
        $this->members_validator = $members_validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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
    
    function removeMember($id, $userId) 
    {        
        $member = $this->members_repository->findWhere([
            'user_id'=>$userId,
            'project_id'=>$id
        ]); 
        $this->members_repository->delete($member[0]["original"]["id"]);                   
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
    
    function createFile(array $data) 
    {        
        $project = $this->repository->skipPresenter()->find($data["project_id"]);
        $project_file = $project->files()->create($data);
        $this->storage->put($project_file->id.".".$data["extension"], $this->filesystem->get($data["file"]));              
    }     
}
