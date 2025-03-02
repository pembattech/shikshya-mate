<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreStudentRequest;
use App\Http\Requests\V1\UpdateStudentRequest;
use App\Http\Requests\V1\CreateStudentUserRequest;
use App\Http\Resources\V1\StudentResource;

use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {

        $student = Student::create($request->validated());

        return response()->json([
            'message' => 'Student created successfully',
            'student' => new StudentResource($student)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        $student->load(['user', 'class.teacher']);

        // Return the student data wrapped in a resource
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        // Update the student record with validated data
        $student->update($request->validated());

        // Return the updated student wrapped in a resource
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // Delete the student record
        $student->delete();

        // Return a response indicating the deletion
        return response()->json(['message' => 'Student deleted successfully']);
    }

    public function createUserAccount(CreateStudentUserRequest $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

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
