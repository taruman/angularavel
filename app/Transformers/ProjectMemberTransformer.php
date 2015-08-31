<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace angularavel\Transformers;

use angularavel\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author Taruman
 */
class ProjectMemberTransformer extends TransformerAbstract 
{
    public function transform(User $user) 
    {
        return [
            "member_id" => $user->id,
            "name" => $user->name
        ];
    }
}
