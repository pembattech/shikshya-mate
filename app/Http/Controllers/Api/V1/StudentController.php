<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreStudentRequest;
use App\Http\Requests\V1\UpdateStudentRequest;
use App\Http\Requests\V1\CreateStudentUserRequest;
use App\Http\Resources\V1\StudentResource;
use App\Filters\V1\StudentFilter;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new StudentFilter();

        $filterItems = $filter->transform($request);
        $studentsQuery = Student::query();

        foreach ($filterItems as $filterItem) {
            if ($filterItem[0] === 'class') {

                $studentsQuery->whereHas('classroom', function ($query) use ($filterItem) {
                    $query->where('class_name', $filterItem[2]);
                });
            } elseif ($filterItem[0] === 'section') {

                $studentsQuery->whereHas('section', function ($query) use ($filterItem) {
                    $query->where('section_name', $filterItem[2]);
                });
            } else {

                $studentsQuery->where($filterItem[0], $filterItem[1], $filterItem[2]);
            }
        }

        $students = $studentsQuery->with(['classroom', 'section'])->get();

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {

        try {
            $student = Student::create($request->validated());

            return response()->json([
                'message' => 'Student created successfully',
                'student' => new StudentResource($student)
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
            $student = Student::findOrFail($id);
            $student->load(['user', 'classroom', 'section']);

            return new StudentResource($student);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The student with ID {$id} was not found.",
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
    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            $student = Student::findOrFail($id);

            $student->update($request->validated());

            return response()->json([
                'message' => 'Student updated successfully!',
                'data' => new StudentResource($student)
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
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The student with ID {$id} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createUserAccount(CreateStudentUserRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        if ($student->user_id) {
            return response()->json(['message' => 'User account already exists.'], 400);
        }

        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $student->name,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'student',
        ]);

        $student->update(['user_id' => $user->id]);

        return response()->json(['message' => 'Student account created successfully!', 'user' => $user]);
    }

}
