<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectNoteRepository;
use angularavel\Repositories\ProjectRepository;
use angularavel\Services\ProjectNoteService;
use angularavel\Services\ProjectService;

class ProjectNoteController extends Controller
{

    private $repository;
    private $project_repository;
    private $service;
    private $project_service;

    public function __construct(ProjectNoteRepository $repository, ProjectRepository $project_repository, ProjectNoteService $service, ProjectService $project_service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->project_service = $project_service;
        $this->project_repository = $project_repository;
    }

    public function index($id)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }    
        $project = $this->project_repository->find($id);
        return $project["data"]["notes"]["data"];
    }

    public function store(Request $request, $id)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }            
        return $this->service->create($request->all());
    }

    public function show($id, $noteId)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }            
        return $this->repository->findWhere(["project_id" => $id, "id" => $noteId]);
    }

    //são realmente 3 parâmetros?
    public function update(Request $request, $id, $noteId)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }            
        return $this->service->update($request->all(), $noteId);
    }

    public function destroy($id, $noteId)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }            
        $this->repository->delete($noteId);
    }
}
