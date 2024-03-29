<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'option_1'=>$this->option_1,
            'option_2'=>$this->option_2,
            'option_3'=>$this->option_3,
            'option_4'=>$this->option_4,
            'correct_answer'=>$this->correct_answer,
        ];
    }
}
