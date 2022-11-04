<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
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
            'price' => $this->price,
            'comments' => CommentResource::collection($this->comments),
            'view_count' => $this->view_count,
            'user_id' => $this->user->id,
            'user_image' => $this->user->image->path,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'image' => $this->images[0]->path,
            'images' => $this->images,
            'published' => $this->created_at->format('M d, Y')
        ];
    }
}
