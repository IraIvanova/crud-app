<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    const NOT_FOUND_MSG = 'Company doesn\'t exists';

    public function all(): Collection
    {
        return Company::get();
    }

    public function create($companyData): Company
    {
        return  Company::create($companyData);
    }

    /**
     * @throws \Exception
     */
    public function show($id): Company
    {
        $company = Company::find($id);
        if (empty($company)) throw new \Exception(self::NOT_FOUND_MSG);

        return $company;
    }

    /**
     * @throws \Exception
     */
    public function update($companyData, $id): Company
    {
        $company = Company::find($id);
        if (empty($company)) throw new \Exception(self::NOT_FOUND_MSG);

        $company->update($companyData);

        return $company;
    }

    /**
     * @throws \Exception
     */
    public function destroy($id): void
    {
        $company = Company::find($id);
        if (empty($company)) throw new \Exception(self::NOT_FOUND_MSG);

        $projects = $company->projects();
//        $projects->map(fn($project) => $project->users()->detach());
        DB::table('project_user')->whereIn('project_id', $projects->pluck('id')->toArray())->delete();

        $projects->delete();
        $company->delete();
    }


}
