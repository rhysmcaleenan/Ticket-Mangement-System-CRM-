<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    // turns dates into a carbon column in to do list 
    protected $dates = [
        'due_date',
        'created_at'
    ];

    // allows these fields to be manually entered
    protected $fillable = [
        'user_id',
        'task',
        'due_date',
        'assigned',
        'status',
    ];

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat('d-m-y', date('d-m-y', strtotime($value)));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
