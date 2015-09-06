<?php 

namespace angularavel\Repositories;

use angularavel\Entities\Cliente;
use Prettus\Repository\Eloquent\BaseRepository;

class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
    public function model()
    {
            return Cliente::class;
    }
    
    public function presenter() {
        return \angularavel\Presenters\ClientePresenter::class;
    }      
}