<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;

use angularavel\Http\Requests;
use angularavel\Http\Controllers\Controller;
use angularavel\Models\Cliente;
use angularavel\Repositories\ClienteRepositoryEloquent;

class ClienteController extends Controller
{
    public function index(ClienteRepositoryEloquent $repository)
    {
        return $repository->all();
    }

    public function store(Request $request)
    {
        return Cliente::create($request->all());
    }

    public function show($id)
    {
        return Cliente::find($id);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $cliente = Cliente::find($id);
        $cliente->update($input);
        return $cliente;
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
    }
}
