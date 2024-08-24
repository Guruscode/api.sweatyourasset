<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'overview' => $this->overview,
            'language' => $this->language,
            'number_of_lessons' => $this->number_of_lessons,
            'what_you_will_learn' => $this->what_you_will_learn,
            'type' => $this->type,
            'hours' => $this->hours,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'curriculums' => $this->curriculums,
        ];
    }
}
