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
            'userID' => $this->user_id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'dateOfBirth' => $this->date_of_birth,
            'rollNumber' => $this->roll_number,
            'address' => $this->address,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'admissionDate' => $this->admission_date,
            'status' => $this->status,
            'slug' => $this->slug,
            'class' => $this->whenLoaded('classroom', fn() => $this->classroom->class_name), // Returns className only if the 'classroom' relationship is loaded
            'section' => $this->whenLoaded('section', fn() => $this->section->section_name), // Relationship to Section
        ];
    }
}
