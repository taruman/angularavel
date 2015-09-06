<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectRepository;
use angularavel\Repositories\ProjectMembersRepository;
use \angularavel\Validators\ProjectValidator;
use \angularavel\Validators\ProjectMembersValidator;
use \angularavel\Validators\ProjectFileValidator;
use \Prettus\Validator\Exceptions\ValidatorException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService {
    private $repository;
    private $members_repository;
    private $validator;
    private $members_validator;
    private $file_validator;
    private $filesystem;
    private $storage;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectFileValidator $file_validator, ProjectMembersRepository $members_repository, ProjectMembersValidator $members_validator, Filesystem $filesystem, Storage $storage) {
        $this->repository = $repository;
        $this->members_repository = $members_repository;
        $this->validator = $validator;
        $this->members_validator = $members_validator;
        $this->file_validator = $file_validator;        
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
        
        if (count($member) > 0)
        {
            $this->members_repository->delete($member[0]["original"]["id"]);
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
    
    function createFile(array $data) 
    {   
        try {
            $this->file_validator->with($data)->passesOrFail();
            $project = $this->repository->skipPresenter()->find($data["project_id"]);
            $project_file = $project->files()->create($data);
            $this->storage->put($project_file->id.".".$data["extension"], $this->filesystem->get($data["file"]));             
            return $project_file;
        } catch (ValidatorException $exc) {
            return [
              "error" => true,
              "message" => $exc->getMessageBag()
            ];
        }                      
    } 
    
    function removeFile($id, $fileId) 
    {        
        $project = $this->repository->skipPresenter()->find($id);        
        $project_file = $project->files()->find($fileId); 
        
        if (count($project_file) > 0)
        {
            $project->files()->find($fileId)->delete();
            $this->storage->delete($project_file->id.".".$project_file->extension);
        }          
    }     
    
    //METODOS USADOS EM CONJUNTO PARA VERIFICAR AUTORIZACAO
    private function isOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();        
        return $this->repository->isOwner($projectId, $userId);        
    }
    
    private function hasMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();        
        return $this->repository->hasMember($projectId, $userId);        
    } 
    
    public function checkProjectPermissions($projectId)
    {
        if($this->isOwner($projectId) || $this->hasMember($projectId))
        {
            return true;
        }
        
        return false;
    }    
}
