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
            'favorite_count' => $this->favorite_count,
            'view_count' => $this->view_count,
            'user_image' => $this->user->image->path,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'images' => $this->images,
            'published' => $this->created_at->format('M d, Y')
        ];
    }
}
