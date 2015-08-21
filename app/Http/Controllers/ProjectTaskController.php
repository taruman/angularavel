<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectTaskRepository;
use angularavel\Services\ProjectTaskService;

class ProjectTaskController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(["project_id" => $id]);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id, $taskId)
    {
        return $this->repository->findWhere(["project_id" => $id, "id" => $taskId]);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
    }
}
