<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * This method is responsible for converting the Skill resource into an array format.
     * It takes the current Skill instance ($this) and formats its properties for API output.
     *
     * @param Request $request The current request instance.
     * @return array<string, mixed> The array representation of the Skill resource.
     */
    public function toArray(Request $request): array
    {
        // Return an array containing the Skill's ID, names in English and Arabic, and image URL.
        return [
            'id' => $this->id, // The unique identifier for the Skill.
            'name_en' => $this->name('en'), // The name of the Skill in English.
            'name_ar' => $this->name('ar'), // The name of the Skill in Arabic.
            'img' => asset("uploads/$this->img"), // The URL to the Skill's associated image.
            'exams' => ExamResource::collection($this->whenLoaded("exams")), // The collection of exams associated with the skill, if loaded.
        ];
    }
}
