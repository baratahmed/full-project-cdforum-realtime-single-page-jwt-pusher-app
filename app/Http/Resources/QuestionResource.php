<?php

namespace App\Http\Resources;

use App\Http\Resources\ReplyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'question_title' => $this-> question_title,
            'question_slug' => $this-> question_slug,
            'question_path' => $this-> path,
            'question_body' => $this-> question_body,
            'replies' =>  ReplyResource::collection($this->replies),
            'replies_count' => $this-> replies->count(),
            'created_at' => $this-> created_at->diffForHumans(),
            'username' => $this->user->name,
            'user_id' => $this->user->id,
        ];
    }
}
