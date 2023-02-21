<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    protected CompanyService $service;

    public function __construct(CompanyService $service)
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
    public function store(CompanyRequest $request): JsonResponse
    {
        $this->service->create($request->validated());

        return $this->respondSuccess(['message' => 'Company successfully created.']);
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
    public function update(CompanyRequest $request, string $id): JsonResponse
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
        return $this->respondSuccess(['message' => 'Company successfully deleted.']);
    }
}
