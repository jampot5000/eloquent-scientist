<?php
/**
 * Created by PhpStorm.
 * User: jholc
 * Date: 20/09/16
 * Time: 0:59
 */

namespace Jampot5000\EloquentScientist;


use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $fillable = ['name'];

    public function executions(){
        return $this->hasMany(Execution::class)->whereExecutionId(null);
    }


}