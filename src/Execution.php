<?php
/**
 * Created by PhpStorm.
 * User: jholc
 * Date: 20/09/16
 * Time: 0:59
 */

namespace Jampot5000\EloquentScientist;


use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    protected $dates = ['start_time', 'end_time'];
    public $timestamps = false;
    protected $casts = ['match' => 'bool'];

    public function experiment(){
        return $this->belongsTo(Experiment::class);
    }

    public function trials(){
        return $this->hasMany(Execution::class,'execution_id');
    }
}