<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Revenues extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'agent_id' => $this->agent ? $this->agent->name : '-',
            'customer_id' => $this->customer ? $this->customer->name : '-',
            'pos_id' => $this->pos ? $this->pos->machine_code : '-',
            'value' => $this->value,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
