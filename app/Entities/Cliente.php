<?php

namespace angularavel\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
    	"nome",
    	"responsavel",
    	"email",
    	"telefone",
    	"endereco",
    	"obs"
    ];
    
    public function projects() {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }
}
