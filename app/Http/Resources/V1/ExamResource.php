<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'subjectID' => $this->subject_id,
            'examDate' => $this->exam_date,
            'totalMarks' => $this->total_marks,
            'class' => new ClassroomResource($this->whenLoaded('classroom')), // Relationship to Classroom,
            'subjects' => new SubjectResource($this->whenLoaded('subjects')) // Relationship to Subject
        ];
    }
}
