<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectRepository;
use angularavel\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    //MANIPULACAO DOS PROJETOS
    public function index()
    {
        return $this->repository->with(["users", "clientes"])->findWhere(array("owner_id" => Authorizer::getResourceOwnerId()));
    }     

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {             
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }        
        
        return $this->repository->with(["users", "clientes"])->find($id);
    }

    public function update(Request $request)
    {
        if($this->service->checkProjectPermissions($request->input("project_id")) == false)
        {
            return ["success" => false];
        }          
        
        return $this->service->update($request->all(), $request->input("id"));
    }

    public function destroy($id)
    {
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }          
        
        $this->repository->delete($id);
    }
    
    //MANIPULACAO DOS MEMBROS DO PROJETO
    public function members($id)
    {        
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }         
        
        $project = $this->repository->find($id);
        return $project["data"]["members"]["data"];
    }     
    
    function addMember(Request $request) 
    {    
        if($this->service->checkProjectPermissions($request->input("project_id")) == false)
        {
            return ["success" => false];
        }          
        return $this->service->addMember($request->all());        
    }
    
    function removeMember($id, $userId) 
    {        
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }         
        $this->service->removeMember($id, $userId);                   
    }
    
    function isMember($id, $userId) 
    {        
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }         
        return $this->service->isMember($id, $userId);               
    }
}
