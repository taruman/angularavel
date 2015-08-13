<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ClienteRepository;
use angularavel\Services\ClienteService;

class ClienteController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ClienteRepository $repository, ClienteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->find($id);
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
