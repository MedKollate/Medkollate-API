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
use Illuminate\Support\Facades\Auth;
use Essa\APIToolKit\Api\ApiResponse;

class ClinicController extends Controller
{
    use APIResponse;
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
        if (auth()->check()) {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $clinic = Clinic::create($data);
            return $this->responseCreated('Clinic created successfully', new ClinicResource($clinic));
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
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
