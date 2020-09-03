<?php

namespace App\Http\Resources\Reservation;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveHistoryResource extends JsonResource
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
            'status' => $this->id,
            'comments' => $this->id,
            'reserve_transaction' => new ReserveTransactionResource( $this->whenLoaded('reserve_transaction') ),
            'admin' => new ReserveTransactionResource( $this->whenLoaded('admin') ),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
