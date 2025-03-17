<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sections = Section::paginate(10);

            if ($sections->isEmpty()) {
                return response()->json(['message' => 'No sections found'], 200);
            }

            return SectionResource::collection($sections);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'section_name' => 'required|string|max:50|unique:sections',
                'class_id' => 'required|exists:classrooms,id',
                'teacher_id' => 'nullable|exists:users,id',
            ]);

            $section = Section::create($validated);
            return new SectionResource($section);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $section = Section::with(['classroom', 'teacher'])->findOrFail($id);
            
            return new SectionResource($section);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "Section with ID {$id} not found"], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $section = Section::findOrFail($id);

            $validated = $request->validate([
                'section_name' => 'required|string|max:50|unique:sections,section_name,' . $id,
                'class_id' => 'required|exists:classrooms,id',
                'teacher_id' => 'nullable|exists:users,id',
            ]);

            $section->update($validated);
            return new SectionResource($section);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "Section with ID {$id} not found"], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();
            return response()->json(['message' => 'Section deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "Section with ID {$id} not found"], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
