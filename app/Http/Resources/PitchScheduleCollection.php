<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PitchScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     'data' => $this->collection->transform(function($outer){
        //         return [
        //             'id' => $outer->id,
        //             'date' => $outer->date,
        //             'client' => $outer->client->name,
        //             'operation' => $outer->operation->name,
        //             'cash' => $outer->cash,
        //             'client_percent' => $outer->client_percent,
        //             'total_cash_profit' => $outer->total_cash_profit,
        //             'company_percent' => $outer->company_percent,
        //         ];
        //     }),
        // ];
    }
}
