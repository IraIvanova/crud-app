<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserService $service;
    public function __construct(UserService $service)
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
    public function update(UserRequest $request, string $id): JsonResponse
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
        return $this->respondSuccess(['message' => 'User successfully deleted.']);
    }
}
