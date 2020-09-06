<?php

namespace App\Http\Resources\Reservation;

use Illuminate\Http\Resources\Json\JsonResource;

class ReserveTransactionResource extends JsonResource
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
            'persons' => $this->persons,
            'reserved_at' => $this->reserved_at->toDayDateTimeString(),
            'request' => $this->request,
            'status' => $this->reserved_at->lt(now()) ? $this->status : 'expired',
            'client' => $this->whenLoaded('client'),
            'space' => new ReserveResource( $this->whenLoaded('space') ),
            'histories' => ReserveHistoryResource::collection( $this->whenLoaded('histories') ),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
