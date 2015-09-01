<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ProjectRepository;
use angularavel\Services\ProjectService;

class ProjectFileController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }   

    public function store(Request $request)
    {
        $file = $request->file("file");
        $extension = $file->getClientOriginalExtension();
                
        $data["file"] = $file;
        $data["extension"] = $extension;
        $data["name"] = $request->name;
        $data["project_id"] = $request->project_id;
        $data["description"] = $request->description;
        
        $this->service->createFile($data);                
    }

}
