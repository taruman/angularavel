<?php

namespace angularavel;

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
}
