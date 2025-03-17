<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->teacher_id,
            'userId' => $this->user_id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'schedule' => $this->schedule,
            'phone' => $this->phone,
            'address' => $this->address,
            'position' => $this->position,
            'hireDate' => $this->hire_date,
            'user' => new UserResource($this->whenLoaded('user')),  // Relationship to User
            'classes' => ClassroomResource::collection($this->whenLoaded('classes')), // Relationship to Classroom
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')), // Relationship to Subject
        ];
    }
}
