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
            'name' => $this->name,
            'userId' => $this->user_id,
            'subject' => $this->subject,
            'phone' => $this->phone,
            'address' => $this->address,
            'position' => $this->position,
            'hireDate' => $this->hire_date,
            'user' => new UserResource($this->whenLoaded('user')),  // Relationship to User
            'classes' => ClassroomResource::collection($this->whenLoaded('classes')), // Relationship to Classroom
        ];
    }
}
