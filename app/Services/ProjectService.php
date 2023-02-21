<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectService extends BaseService
{
    const NOT_FOUND_MSG = 'Project doesn\'t exists.';

    public function all(): Collection
    {
        return Project::with(['users:id,name,surname', 'company:id,name'])->get();
    }

    /**
     * @throws \Exception
     */
    public function getProjectUsers($id): Collection
    {
        $project = Project::find($id);

        if ($this->ifNotExists($project)) throw new \Exception(self::NOT_FOUND_MSG);

        return $project->users;
    }

    public function create($projectData): Project
    {
        $project = Project::create($projectData);

        $this->attachUsers($project, $projectData['users'] ?? []);
        return $project;
    }

    /**
     * @throws \Exception
     */
    public function show($id): Project
    {
        $project = Project::find($id);
        if ($this->ifNotExists($project)) throw new \Exception(self::NOT_FOUND_MSG);

        return $project;
    }

    /**
     * @throws \Exception
     */
    public function update($projectData, $id): Project
    {
        $project = Project::find($id);
        if ($this->ifNotExists($project)) throw new \Exception(self::NOT_FOUND_MSG);

        $project->update($projectData);
        $this->attachUsers($project, $projectData['users'] ?? []);

        return $project;
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        if ($this->ifNotExists($project)) throw new \Exception(self::NOT_FOUND_MSG);

        $project->users()->detach();

        $project->delete();
    }


    protected function attachUsers($project, $users){
        if(!empty($users)) $project->users()->sync($users);
    }
}
