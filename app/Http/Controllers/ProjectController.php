<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectRepository;
use angularavel\Repositories\ProjectMembersRepository;
use angularavel\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{

    private $repository;
    private $service;
    private $members_repository;

    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectMembersRepository $members_repository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->members_repository = $members_repository;
    }

    public function index()
    {
        return $this->repository->with(["users", "clientes"])->findWhere(array("owner_id" => Authorizer::getResourceOwnerId()));
    }
    
    public function members($id)
    {
        $project = $this->repository->find($id);
        return $project->members;
        //return $this->members_repository->with(["users"])->findByField('project_id', $id);
        //qual é a melhor forma?
    }    

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {             
        if($this->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }        
        
        return $this->repository->with(["users", "clientes"])->find($id);
    }

    public function update(Request $request, $id)
    {
        if($this->isOwner($id) == false)
        {
            return ["success" => false];
        }          
        
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        if($this->isOwner($id) == false)
        {
            return ["success" => false];
        }          
        
        $this->repository->delete($id);
    }
    
    function addMember(Request $data) {   
        
        return $this->service->addMember($data->all());
        
    }
    
    function removeMember($id) {
        
        $this->members_repository->delete($id);     
              
    }
    
    //rever este método, tendo em vista o hasMember abaixo
    function isMember($id, $userId) {
        
        return $this->service->isMember($id, $userId); 
              
    }
    
    function isOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();        
        return $this->repository->isOwner($projectId, $userId);        
    }
    
    function hasMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();        
        return $this->repository->hasMember($projectId, $userId);        
    } 
    
    function checkProjectPermissions($projectId)
    {
        if($this->isOwner($projectId) || $this->hasMember($projectId))
        {
            return true;
        }
        
        return false;
    }
}
