<?php

namespace App\Http\Resources;

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
        return [
           'id' => $this->id,
           'title' => $this->title,
           'slug' => $this->slug,
           'votes_count' => $this->votes_count,
           'answers_count' => $this->answers_count,
           'status' => $this->status,
           'excerpt' => $this->excerpt,
           'user' => new UserResource($this->user),
           'created_date' => $this->created_date,
           'views' => $this->views,
        ];
    }
}
