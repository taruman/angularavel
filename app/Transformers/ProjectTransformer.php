<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace angularavel\Transformers;

use angularavel\Entities\Project;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author Taruman
 */
class ProjectTransformer extends TransformerAbstract 
{
    public function transform(Project $project) 
    {
        return [
            "project_id" => $project->id,
            "client_id" => $project->client_id,
            "owner_id" => $project->owner_id,
            "nome" => $project->nome,
            "description" => $project->description,
            "progress" => $project->progress,
            "status" => $project->status,
            "due_date" => $project->due_date
        ];
    }
}
