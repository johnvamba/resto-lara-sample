<?php

namespace App\Http\Resources\Reservation;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type,
            'status' => $this->status,
            'description' => $this->description,
            'created_at' => $this->created_at->toDateTimeString(),
            'url' => \route('admin.reservation.space', ['space' => $this->resource]),
            'transactions' => ReserveTransactionResource::collection( $this->whenLoaded('transactions') ),
        ];
    }
}
