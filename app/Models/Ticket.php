<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    /**
    * Fillable white lists these fields allowing them to be massive/ bulk fillable 
    */

    protected $fillable = [
        'client_id',
        'callername',
        'title',
        'type',
        'description',
        'solution',
        'status',
        'timelength',
        'createdby',
        'chargeable'
    ];

    /**
     * Client has Many Tickets
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class); 
    }
}
