<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeyFilesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
			'id' => $this->id,
			'name_key' => $this->name_key,
			'line' => $this->line,
			'id_file' => $this->id_file,
			'created_at' => date_format(date_create($this->created_at), 'Y-m-d H:i:s a'),
		];
    }
}
