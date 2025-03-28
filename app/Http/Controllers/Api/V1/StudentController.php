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
use App\Models\Classroom;
use App\Models\Section;

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
        $studentsQuery = Student::query()->where('status', 'approved');

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
                'success' => true,
                'message' => 'Student created successfully',
                'student' => new StudentResource($student)
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $student = Student::where('slug', $slug)->firstOrFail();
            $student->load(['user', 'classroom', 'section']);

            return response()->json([
                'success' => true,
                'message' => 'Student details retrieved successfully',
                'student' => new StudentResource($student)
            ], 201);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "The student with ID {$slug} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $slug)
    {
        try {

            $student = Student::where('slug', $slug)->firstOrFail();

            $student->update($request->validated());

            $student->load(['classroom', 'section']);

            return response()->json([
                'success' => true,
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
    public function destroy($slug)
    {
        try {
            $student = Student::where('slug', $slug)->firstOrFail();
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The student with ID {$slug} was not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createUserAccount(CreateStudentUserRequest $request, $slug)
    {
        $student = Student::where('slug', $slug)->firstOrFail();

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

    public function approveStudent($slug)
    {
        $student = Student::where('slug', $slug)->firstOrFail();
        $student->update(['status' => 'approved']);

        // Optional: Send a notification
        // $student->user->notify(new StudentApprovedNotification());

        return response()->json(['message' => 'Student approved successfully']);
    }

    public function rejectStudent($slug)
    {
        $student = Student::where('slug', $slug)->firstOrFail();
        $student->update(['status' => 'rejected']);

        return response()->json(['message' => 'Student rejected']);
    }

    public function getpendingStudents()
    {
        $students = Student::pending()->get();
        return response()->json(['message' => 'Pending students', 'data' => StudentResource::collection($students)]);
    }

    public function getApprovedStudents() //MSG: Not implemented
    {
        $students = Student::approved()->get();
        return response()->json(['message' => 'Approved students', 'data' => StudentResource::collection($students)]);
    }

    public function getRejectedStudents() //MSG: Not implemented
    {
        $students = Student::rejected()->get();
        return response()->json(['message' => 'Rejected students', 'data' => StudentResource::collection($students)]);
    }

}
