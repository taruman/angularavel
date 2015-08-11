<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;
use angularavel\Repositories\ClienteRepository;

class ClienteController extends Controller
{

    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $cliente = $this->repository->find($id);
        $cliente->update($input);
        return $cliente;
    }

    public function destroy($id)
    {
        $cliente = $this->repository->find($id);
        $cliente->delete();
    }
}
