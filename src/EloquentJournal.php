<?php
/**
 * Created by PhpStorm.
 * User: jholc
 * Date: 20/09/16
 * Time: 1:32
 */

namespace Jampot5000\EloquentScientist;


use Illuminate\Database\Eloquent\Model;
use Scientist\Experiment;
use Scientist\Journals\Journal;
use Scientist\Report;
use Scientist\Result;

class EloquentJournal implements Journal
{
    protected $instance;
    protected $control;

    /**
     * @param Experiment $experiment
     * @return Model
     */
    private function findExperiment(Experiment $experiment){
        $experimentModel = config('scientist.models.experiment.class');
        $experimentInstance = $experimentModel::whereName($experiment->getName())->first();
        if($experimentInstance == null)
        {
            $experimentInstance = new $experimentModel;
            $experimentInstance->{config('scientist.models.experiment.fields.name')} = $experiment->getName();
            $experimentInstance->save();
        }

        $this->instance = $experimentInstance;

        return $this->instance;
    }
    public function report(Experiment $experiment, Report $report)
    {
        $this->findExperiment($experiment);

        $this->createControl($report->getControl());

        $this->createTrials($report->getTrials());
    }

    private function createControl($control)
    {
        $this->control = $this->createExecution($control);
        $this->control->save();
        return $this->control;

    }

    private function createExecution(Result $control, $name = null)
    {
        $execution = new Execution;
        $execution->experiment_id = $this->instance->id;
        foreach (config('scientist.models.execution.fields') as $key => $fieldName)
        {
            if($fieldName != '') {
                if ($key == 'name') {
                    $this->setName($fieldName, $name, $execution);
                } elseif ($key == 'result') {
                    $execution->{$fieldName} = $this->formatResult($control->getValue());
                } elseif ($key == 'match') {
                    $execution->{$fieldName} = $control->{camel_case('is_' . $key)}();
                } else {
                    $execution->{$fieldName} = $control->{camel_case('get_' . $key)}();
                }
            }
        }

        return $execution;
    }

    private function setName($fieldName, $name, $execution)
    {
        if($name == null)
            $name = "control";

        $execution->{$fieldName} = $name;
    }

    private function formatResult($param)
    {
        return var_export($param,true);
    }

    private function createTrials($trials)
    {
        foreach($trials as $name => $trial)
        {
            $trialInstance = $this->createExecution($trial,$name);
            $trialInstance->execution_id = $this->control->id;
            $trialInstance->save();
        }
    }
}