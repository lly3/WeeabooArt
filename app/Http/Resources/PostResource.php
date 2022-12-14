<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\ErrorHandler\Collecting;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'is_saleable' => $this->is_saleable,
            'price' => $this->price,
            'favorite_count' => $this->favorite_count,
            'view_count' => $this->view_count,
            'user_id' => $this->user->id,
            'user_image' => $this->user->image->path,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'image' => $this->image->path,
            'published' => $this->created_at->format('M d, Y'),
            'tags' => $this->tags,
            'comments' => CommentResource::collection($this->comments->sortByDesc('created_at')),
        ];
    }
}
