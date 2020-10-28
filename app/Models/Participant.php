<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    /**
     * The attributes that should be visible publicly.
     *
     * @var array
     */
    protected $visible = [
        'first_name',
        'last_name'
    ];

    public function event() {
        return $this->belongsTo('App\Models\Event');
    }

}
