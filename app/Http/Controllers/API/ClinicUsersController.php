<?php

namespace App\Http\Controllers\Api;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class ClinicUsersController extends Controller
{
    public function index(Request $request, Clinic $clinic): UserCollection
    {
        $this->authorize('view', $clinic);

        $search = $request->get('search', '');

        $users = $clinic
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Clinic $clinic): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'first_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'address' => ['nullable', 'max:255', 'string'],
            'designation' => ['nullable', 'max:255', 'string'],
            'emergency_name' => ['nullable', 'max:255', 'string'],
            'emergency_phone' => ['nullable', 'max:255', 'string'],
            'emergency_address' => ['nullable', 'max:255', 'string'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'genotype' => ['nullable', 'max:255', 'string'],
            'blood_group' => ['nullable', 'max:255', 'string'],
            'unique_id' => ['nullable', 'max:255', 'string'],
            'role' => ['required', 'max:255', 'string'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $clinic->users()->create($validated);

        return new UserResource($user);
    }
}
