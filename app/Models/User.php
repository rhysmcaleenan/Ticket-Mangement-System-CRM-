<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {

    use Notifiable,
        HasRoles;

    /**
    * Fillable white lists these fields allowing them to be massive/ bulk fillable 
    */
    protected $fillable = [
        'name',
        'email',
        'job',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'owner_id');
    }

    public function avatar()
    {
        return asset($this->image ? 'public/storage/' . $this->image : 'public/img/avatar.jpg');
    }
}