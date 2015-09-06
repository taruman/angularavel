<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace angularavel\Transformers;

use angularavel\Entities\Cliente;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author Taruman
 */
class ClienteTransformer extends TransformerAbstract 
{
    public function transform(Cliente $cliente) 
    {
        return [
            "id_cliente" => $cliente->id,
            "nome" => $cliente->nome,
            "responsavel" => $cliente->responsavel,
            "email" => $cliente->email,
            "telefone" => $cliente->telefone,
            "endereco" => $cliente->endereco,
            "obs" => $cliente->obs,
            "projects" => $cliente->projects
        ];
    }
}
