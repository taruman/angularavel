<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace angularavel\Transformers;

use angularavel\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author Taruman
 */
class ProjectTaskTransformer extends TransformerAbstract 
{
    public function transform(ProjectTask $task) 
    {
        return [
            "id_task" => $task->id,
            "name" => $task->name,
            "project_id" => $task->project_id,
            "start_date" => $task->start_date,
            "due_date" => $task->due_date,
            "status" => $task->status             
        ];
    }
}
