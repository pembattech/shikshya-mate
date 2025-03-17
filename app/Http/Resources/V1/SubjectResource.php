<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->subject_name,
            'classrooms' => ClassroomResource::collection($this->whenLoaded('classrooms')), // Relationship to Classroom
            'teachers' => TeacherResource::collection($this->whenLoaded('teachers')), // Relationship to Teacher
        ];
    }
}
