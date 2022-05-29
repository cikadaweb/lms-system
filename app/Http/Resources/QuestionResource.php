<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'correct_answer' => $this->correct_answer,
            'incorrect_answers' => $this->incorrect_answers,
            'question' => $this->question,
            'type' => $this->type,
        ];
        
        // return parent::toArray($request);
    }
}