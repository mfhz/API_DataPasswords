<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HostnameResource extends JsonResource
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
			'name' => $this->computer_path,
			'progress' => $this->server_path,
			'count_file' => $this->id_hostname,
			'created_at' => date_format(date_create($this->created_at), 'Y-m-d H:i:s a'),
		];
    }
}
