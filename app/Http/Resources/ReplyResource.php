<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'id' => $this->id,
            'reply_body' => $this->reply_body,
            'question_slug' => $this->question->question_slug,
            'username' => $this->user->name,
            'user_id' => $this->user_id,
            'like_count' => $this->likes->count(),
            'liked' => !! $this->likes->where('user_id',auth()->id())->count(),
            'created_at' => $this->created_at->diffForHumans(),

        ];
    }
}
