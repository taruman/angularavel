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
        return $this->repository->with(["users", "clientes"])->all();
    }
    
    public function members($id)
    {
        return $this->members_repository->with(["users"])->findByField('project_id', $id);
    }    

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {     
        $user_id = Authorizer::getResourceOwnerId();
        
        if($this->repository->isOwner($id, $user_id) == false)
        {
            return ["success" => false];
        }        
        
        return $this->repository->with(["users", "clientes"])->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
    }
    
    function addMember(Request $data) {   
        
        return $this->service->addMember($data->all());
        
    }
    
    function removeMember($id) {
        
        $this->members_repository->delete($id);     
              
    }
    
    function isMember($id, $userId) {
        
        return $this->service->isMember($id, $userId); 
              
    }   
}
