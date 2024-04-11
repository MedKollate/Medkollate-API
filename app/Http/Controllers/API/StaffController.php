<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\CreateStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use App\Http\Resources\Staff\StaffResource;
use App\Models\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection 
    {
        $staff = Staff::useFilters()->dynamicPaginate();

        return StaffResource::collection($staff);
    }

    public function store(CreateStaffRequest $request): JsonResponse
    {
        $password = Str::random(8);
        $newStaff = new Staff();
        $data = $request->validated();
        $data['password'] = Hash::make($password);
        $data['unique_id'] = $newStaff->generateUserName($data['first_name']);
        $staff = Staff::create($request->validated());
        
        // send username and password to staff email
        

        return $this->responseCreated('Staff created successfully', new StaffResource($staff));
    }

    public function show(Staff $staff): JsonResponse
    {
        return $this->responseSuccess(null, new StaffResource($staff));
    }

    public function update(UpdateStaffRequest $request, Staff $staff): JsonResponse
    {
        $staff->update($request->validated());

        return $this->responseSuccess('Staff updated Successfully', new StaffResource($staff));
    }

    public function destroy(Staff $staff): JsonResponse
    {
        $staff->delete();

        return $this->responseDeleted();
    }

    // login route for staffs
    public function login (Request $request, Staff $staff) 
    {
           // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate the staff
    $staff = Staff::where('email', $request->email)->first();

    if (!$staff || !Hash::check($request->password, $staff->password)) {
        // Authentication failed
        return $this->responseUnauthorized('Invalid email or password');
    }

    // Generate a new API token for the staff
    $token = $staff->createToken('staff-token')->plainTextToken;

    // Return the token as a response
    return $this->responseSuccess('Login successful', ['token' => $token]);


    }

}
