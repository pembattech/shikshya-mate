<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTeacherRequest;
use App\Http\Requests\V1\UpdateTeacherRequest;
use App\Http\Requests\V1\CreateTeacherUserRequest;
use App\Http\Resources\V1\TeacherResource;
use App\Models\Teacher;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);

        if ($teachers->isEmpty()) {
            return response()->json([
                'message' => 'No teachers found.',
            ], 200);
        }

        return TeacherResource::collection($teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->validated());

            return response()->json([
                'message' => 'Teacher created successfully',
                'student' => new TeacherResource($teacher)
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error occurred',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->load(['user', 'classes']);

            return new TeacherResource($teacher);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The teacher with ID {$id} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);

            $teacher->update($request->validated());

            return response()->json([
                'message' => 'Teacher updated successfully!',
                'data' => new TeacherResource($teacher)
            ], 200);


        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();
            return response()->json(['message' => 'Teacher deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The teacher with ID {$id} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createTeacherAccount(CreateTeacherUserRequest $request, $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);

            if ($teacher->user_id) {
                return response()->json(['message' => 'User account already exists.'], 400);
            }

            $validatedData = $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $teacher->name,
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => 'teacher',
            ]);

            $teacher->update(['user_id' => $user->id]);

            return response()->json([
                'message' => 'Teacher account created successfully!',
                'user' => $user
            ], 201);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Teacher not found.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

}
