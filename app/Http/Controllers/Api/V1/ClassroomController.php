<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClassroomResource;
use App\Http\Requests\V1\StoreClassroomRequest;
use App\Http\Requests\V1\UpdateClassroomRequest;
use App\Models\Classroom;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::paginate(10);

        if ($classrooms->isEmpty()) {
            return response()->json([
                'message' => 'No classrooms found.',
            ], 200);
        }

        return ClassroomResource::collection($classrooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        try {
            $classroom = Classroom::create($request->validated());

            return response()->json([
                'message' => 'Classroom created successfully',
                'classroom' => new ClassroomResource($classroom)
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
            
            $classroom = Classroom::with(['teacher', 'students', 'subjects'])->findOrFail($id);

            return new ClassroomResource($classroom);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The classrooms with ID {$id} was not found.",
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
    public function update(UpdateClassroomRequest $request, $id)
    {
        try {
            $classroom = Classroom::findOrFail($id);

            $classroom->update($request->validated());

            return response()->json([
                'message' => 'Classroom updated successfully!',
                'data' => new ClassroomResource($classroom)
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
            $classroom = Classroom::findOrFail($id);
            $classroom->delete();
            return response()->json(['message' => 'Classroom deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The classroom with ID {$id} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
