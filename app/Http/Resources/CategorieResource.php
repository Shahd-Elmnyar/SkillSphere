<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Define the CategorieResource class which extends JsonResource
class CategorieResource extends JsonResource
{
    /**
     * Transform the resource instance into an array.
     *
     * This method is responsible for converting the resource into an array format
     * that can be easily converted to JSON, and eventually sent as a response to the API consumer.
     *
     * @param Request $request The current request instance.
     * @return array<string, mixed> The array representation of the resource.
     */
    public function toArray(Request $request): array
    {
        // Return the array representation of the category resource.
        return [
            'id' => $this->id, // The unique identifier for the category.
            'name_en' => $this->name('en'), // The name of the category in English.
            'name_ar' => $this->name('ar'), // The name of the category in Arabic.
            'skills' => SkillResource::collection($this->whenLoaded("skills")), // The collection of skills associated with the category, if loaded.
        ];
    }
}
