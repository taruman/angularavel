<?php

namespace angularavel\Http\Controllers;

use Illuminate\Http\Request;

use angularavel\Http\Requests;
use angularavel\Http\Controllers\Controller;
use angularavel\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::all();
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
        return Cliente::where('id', $id)->update($input);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
    }
}
