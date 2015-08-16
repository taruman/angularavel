<?php

namespace angularavel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        "owner_id",
        "client_id",
        "nome",
        "description",
        "progress",
        "status",
        "due_date"
    ];
    
    public function notes() {
        return $this->hasMany(ProjectNote::class, 'project_id', 'id');
    }
    
    public function users() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    
    public function clientes() {
        return $this->belongsTo(Cliente::class, 'client_id', 'id');
    }

}
