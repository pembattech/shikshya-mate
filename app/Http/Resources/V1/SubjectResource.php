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
            'name' => $this->name,
            'classID' => $this->class_id,
            'teacherID' => $this->teacher_id,
            'user' => new UserResource($this->whenLoaded('teacher')),  // Relationship to Teacher
            'classes' => new ClassroomResource($this->whenLoaded('class')),  // Relationship to Classroom

        ];
    }
}
