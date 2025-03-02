<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userID' => $this->user_id,
            'classID' => $this->class_id,
            'section' => $this->section,
            'rollNumber' => $this->roll_number,
            'dateOfBirth' => $this->date_of_birth,
            'parentID' => $this->parent_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'admissionDate' => $this->admission_date,
            'user' => new UserResource($this->whenLoaded('user')),  // Relationship to User
            'class' => new ClassroomResource($this->whenLoaded('class')), // Relationship to Classroom
        ];
    }
}
