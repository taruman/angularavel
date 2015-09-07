<?php

namespace angularavel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use angularavel\Entities\Project;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace angularavel\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
    
    public function isOwner($project_id, $user_id)
    {
        $projeto = $this->findWhere(array("id" => $project_id, "owner_id" => $user_id));
        if(count($projeto['data']) > 0)
        {
            return true;
        }
        
        return false;
    }
    
    public function hasMember($project_id, $user_id)
    {        
        $project = $this->find($project_id);
        
        foreach ($project["data"]["members"]["data"] AS $member)
        {
            if($member["member_id"] == $user_id)
            {
                return true;
            }
        }
        
        return false;
    } 
    
    public function presenter() {
        return \angularavel\Presenters\ProjectPresenter::class;
    }
}