<?php

namespace App\Http\Resources;

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
            'id' => $this->id, // The unique identifier for the exam.
            'name_en' => $this->name('en'), // The name of the exam in English.
            'name_ar' => $this->name('ar'), // The name of the exam in Arabic.
            'description_en' => $this->description('en'), // The description of the exam in English.
            'description_ar' => $this->description('ar'), // The description of the exam in Arabic.
            'img' => asset("uploads/$this->img"), // The URL to the exam's associated image.
            'questions_number'=>$this->questions_number, // The question number
            'difficulty'=>$this->difficulty, // The difficulty
            'duration_mins'=>$this->duration_mins, // The duration of the exam
            'questions' => QuestionsResource::collection($this->whenLoaded("questions")), // The collection of questions associated with the skill, if loaded.
        ];
    }
}
