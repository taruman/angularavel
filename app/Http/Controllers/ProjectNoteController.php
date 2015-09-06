<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectNoteRepository;
use angularavel\Services\ProjectNoteService;
use angularavel\Services\ProjectService;

class ProjectNoteController extends Controller
{

    private $repository;
    private $service;
    private $project_service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service, ProjectService $project_service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->project_service = $project_service;
    }

    public function index($id)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }    
        return $this->repository->findWhere(["project_id" => $id]);
    }

    public function store(Request $request)
    {
        if($this->project_service->checkProjectPermissions($request->input("project_id")) == false)
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

    public function update(Request $request)
    {
        if($this->project_service->checkProjectPermissions($request->input("project_id")) == false)
        {
            return ["success" => false];
        }            
        return $this->service->update($request->all(), $request->input("id"));
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
