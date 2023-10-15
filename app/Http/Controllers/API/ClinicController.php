<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinic\CreateClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;
use App\Http\Resources\Clinic\ClinicResource;
use App\Models\Clinic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection 
    {
        $clinics = Clinic::useFilters()->dynamicPaginate();

        return ClinicResource::collection($clinics);
    }

    public function store(CreateClinicRequest $request): JsonResponse
    {
        $clinic = Clinic::create($request->validated());

        return $this->responseCreated('Clinic created successfully', new ClinicResource($clinic));
    }

    public function show(Clinic $clinic): JsonResponse
    {
        return $this->responseSuccess(null, new ClinicResource($clinic));
    }

    public function update(UpdateClinicRequest $request, Clinic $clinic): JsonResponse
    {
        $clinic->update($request->validated());

        return $this->responseSuccess('Clinic updated Successfully', new ClinicResource($clinic));
    }

    public function destroy(Clinic $clinic): JsonResponse
    {
        $clinic->delete();

        return $this->responseDeleted();
    }

}
