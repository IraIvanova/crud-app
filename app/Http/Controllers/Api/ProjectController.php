<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    protected ProjectService $service;
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->respondSuccess($this->service->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $this->service->create($request->validated());

        return $this->respondSuccess(['message' => 'Project successfully created.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $data = $this->service->show($id);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
        return $this->respondSuccess($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, string $id): JsonResponse
    {
        try {
            $data = $this->service->update($request->validated(), $id);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
        return $this->respondSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->service->destroy($id);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
        return $this->respondSuccess(['message' => 'Project successfully deleted.']);
    }

    public function getUsers(string $id): JsonResponse
    {
        try {
            $users = $this->service->getProjectUsers($id);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
        return $this->respondSuccess($users);
    }
}
