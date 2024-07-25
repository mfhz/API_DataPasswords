<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilesResource extends JsonResource
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
			'computer_path' => $this->computer_path,
			'server_path' => $this->server_path,
			'id_hostname' => $this->id_hostname,
			'created_at' => date_format(date_create($this->created_at), 'Y-m-d H:i:s a'),
		];
    }
}
