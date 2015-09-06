<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectTaskRepository;
use \angularavel\Validators\ProjectTaskValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService {
    private $repository;
    private $validator;
    
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator) {
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
    
    function removeTask($id, $taskId) 
    {        
        $task = $this->repository->skipPresenter()->findWhere([
            'id'=>$taskId,
            'project_id'=>$id
        ]); 
        
        if (count($task) > 0)
        {
            $this->repository->delete($taskId);
        }                           
    }      
}
