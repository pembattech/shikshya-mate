<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreExamRequest;
use App\Http\Requests\V1\UpdateExamRequest;
use App\Http\Resources\V1\ExamResource;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $exams = Exam::paginate(10);

            if ($exams->isEmpty()) {
                return response()->json([
                    'message' => 'No exams found'
                ], 200);
            }

            return response()->json([
                'exams' => ExamResource::collection($exams)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request): JsonResponse
    {
        try {
            $exam = Exam::create($request->validated());
            return response()->json([
                'message' => 'Exam created successfully',
                'student' => new ExamResource($exam)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {

            $exam = Exam::findOrFail($id);

            $exam->load('classroom', 'subjects');

            return response()->json([
                'message' => 'Exam retrieved successfully',
                'exam' => new ExamResource($exam)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Exam not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
    {
        try {
            $exam->update($request->validated());
            return response()->json([
                'message' => 'Exam updated successfully',
                'student' => new ExamResource($exam)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $exam->delete();
            return response()->json([
                'message' => 'Exam deleted successfully'
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
