<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    
    public function scheduleUser1()
    {
        return $this->belongsTo('App\User', 'user_id_1', 'id');
    }

    public function scheduleUser2()
    {
        return $this->belongsTo('App\User', 'user_id_2', 'id');
    }
   
}

