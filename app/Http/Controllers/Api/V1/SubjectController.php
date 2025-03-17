<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreSubjectRequest;
use App\Http\Requests\V1\UpdateSubjectRequest;
use App\Http\Resources\V1\SubjectResource;
use App\Models\Subject;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(10);

        if ($subjects->isEmpty()) {
            return response()->json([
                'message' => 'No subjects found.',
            ], 200);
        }

        return SubjectResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        try {
            $subject = Subject::create($request->validated());

            return response()->json([
                'message' => 'Subject created successfully',
                'student' => new SubjectResource($subject)
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
            $subjects = Subject::findOrFail($id);
            // $subjects->load(['classrooms', 'teachers']);

            $subjects->load(['teachers']);

            return new SubjectResource($subjects);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The subjects with ID {$id} was not found.",
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
    public function update(UpdateSubjectRequest $request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $subject->update($request->validated());

            return response()->json([
                'message' => 'Subject updated successfully!',
                'data' => new SubjectResource($subject)
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
            $subject = Subject::findOrFail($id);
            $subject->delete();
            return response()->json(['message' => 'Subject deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The subject with ID {$id} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
