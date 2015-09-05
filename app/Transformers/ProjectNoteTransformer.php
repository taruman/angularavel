<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace angularavel\Transformers;

use angularavel\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

/**
 * Description of ProjectTransformer
 *
 * @author Taruman
 */
class ProjectNoteTransformer extends TransformerAbstract 
{
    public function transform(ProjectNote $note) 
    {
        return [
            "project_id" => $note->project_id,
            "title" => $note->title,
            "note" => $note->note
        ];
    }
}
