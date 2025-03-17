<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->section_id,
            'name' => $this->section_name,
            'classID' => $this->class_id,
            'teacherID' => $this->teacher_id,
            'class' => new ClassroomResource($this->whenLoaded('classroom')), // Relationship to Classroom
            'teacher' => new TeacherResource($this->whenLoaded('teacher')) // Relationship to Teacher
        ];
    }
}
