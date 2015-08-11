<?php 

namespace angularavel\Repositories;

use angularavel\Models\Cliente;
use Prettus\Repository\Eloquent\BaseRepository;

class ClienteRepositoryEloquent extends BaseRepository
{
	public function model()
	{
		return Cliente::class;
	}
}