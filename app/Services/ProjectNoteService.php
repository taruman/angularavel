<?php

namespace angularavel\Services;
use angularavel\Repositories\ProjectNoteRepository;
use \angularavel\Validators\ProjectNoteValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService {
    private $repository;
    private $validator;
    
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator) {
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
    
    function removeNote($id, $noteId) 
    {        
        $note = $this->repository->skipPresenter()->findWhere([
            'id'=>$noteId,
            'project_id'=>$id
        ]); 
        
        if (count($note) > 0)
        {
            $this->repository->delete($noteId);
        }                           
    }     
}
