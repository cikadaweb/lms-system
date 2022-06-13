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
            'question' => $this->question,
            'is_active' => $this->is_active,
            'type' => $this->type,
            'test_id' => $this->test_id,
            'answers' => AnswerResource::collection($this->whenLoaded('answers')),
        ];

        // return [
        //     'id' => $this->id,
        //     'question' => $this->question,
        //     'is_active' => $this->is_active,
        //     'type' => $this->type,
        //     'test_id' => $this->test_id,
        // ];
        
        // return parent::toArray($request);
    }
}