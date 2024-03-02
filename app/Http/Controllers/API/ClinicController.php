<?php

namespace App\Http\Controllers\Api;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\ClinicCollection;
use App\Http\Requests\ClinicStoreRequest;
use App\Http\Requests\ClinicUpdateRequest;

class ClinicController extends Controller
{
    public function index(Request $request): ClinicCollection
    {
        $this->authorize('view-any', Clinic::class);

        $search = $request->get('search', '');

        $clinics = Clinic::search($search)
            ->latest()
            ->paginate();

        return new ClinicCollection($clinics);
    }

    public function store(ClinicStoreRequest $request): ClinicResource
    {
        $this->authorize('create', Clinic::class);

        $validated = $request->validated();

        $clinic = Clinic::create($validated);

        return new ClinicResource($clinic);
    }

    public function show(Request $request, Clinic $clinic): ClinicResource
    {
        $this->authorize('view', $clinic);

        return new ClinicResource($clinic);
    }

    public function update(
        ClinicUpdateRequest $request,
        Clinic $clinic
    ): ClinicResource {
        $this->authorize('update', $clinic);

        $validated = $request->validated();

        $clinic->update($validated);

        return new ClinicResource($clinic);
    }

    public function destroy(Request $request, Clinic $clinic): Response
    {
        $this->authorize('delete', $clinic);

        $clinic->delete();

        return response()->noContent();
    }
}
