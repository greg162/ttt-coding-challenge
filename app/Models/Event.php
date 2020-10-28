<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    public $timestamps = true;

    /**
     * The attributes that should be visible publicly.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'event_date',
        'information',
        'participants'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'event_date' => 'datetime:Y-m-d',
    ];

    public function participants() {
        return $this->hasMany('App\Models\Participant');
    }


    //Validation rules for the event list endpoint
    static function validationRulesIndex() {
        return [
            "start_date" => "date_format:Y M j",
            "end_date"   => "date_format:Y M j",
            "query"      => "string|max:255",
        ];
    }

}
