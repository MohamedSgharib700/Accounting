<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Installments extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'agent_id' => $this->agent ? $this->agent->name : '-',
            'customer_id' => $this->customer ? $this->customer->name : '-',
            'pos_id' => $this->pos ? $this->pos->machine_code : '-',
            'value' => $this->value,
            'due_date' => Carbon::parse($this->due_date)->format('d/m/Y'),
            'payment_date' => Carbon::parse($this->payment_date)->format('d/m/Y'),
            'status' => $this->status ? 'Paid' : 'Needed',
        ];
    }
}
