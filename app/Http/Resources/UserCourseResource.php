<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->course->id,
            'name' => $this->course->name,
            'price' => $this->course->price,
            'overview' => $this->course->overview,
            'language' => $this->course->language,
            'number_of_lessons' => $this->course->number_of_lessons,
            'what_you_will_learn' => $this->course->what_you_will_learn,
            'type' => $this->course->type,
            'hours' => $this->course->hours,
            'created_at' => $this->course->created_at,
            'updated_at' => $this->course->updated_at,
            'curriculums' => $this->course->curriculums,
        ];
    }
}
