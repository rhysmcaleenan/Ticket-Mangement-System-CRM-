<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    /**
    * Fillable White lists these fields which allows them to become mass assignable
    */
    protected $fillable = [
        'user_id',
        'client',
        'supporttype',
        'email',
        'telephone',
        'address',
        'city',
        'postcode',
        'servers',
        'workstations',
        'printers',
        'notes'
    ];

    /**
     * Client has Many Tickets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        // Get the results of the relationship.
        return $this->hasMany(Ticket::class);
    }
}
