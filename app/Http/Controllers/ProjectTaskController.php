<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectTaskRepository;
use angularavel\Services\ProjectTaskService;
use angularavel\Services\ProjectService;

class ProjectTaskController extends Controller
{

    private $repository;
    private $service;
    private $project_service;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service, ProjectService $project_service)
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

    public function show($id, $taskId)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }         
        return $this->repository->findWhere(["project_id" => $id, "id" => $taskId]);
    }

    public function update(Request $request)
    {
        if($this->project_service->checkProjectPermissions($request->input("project_id")) == false)
        {
            return ["success" => false];
        }         
        return $this->service->update($request->all(), $request->input("id"));
    }

    public function destroy($id, $taskId)
    {
        if($this->project_service->checkProjectPermissions($id) == false)
        {
            return ["success" => false];
        }         
        $this->repository->delete($taskId);
    }
}
