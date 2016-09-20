<?php
return [
    'models' => [
        'experiment' => [
            'class' => Jampot5000\EloquentScientist\Experiment::class,
            'fields' => [
                'name' => 'name',
            ]
        ],

        'execution' => [
            'class' => Jampot5000\EloquentScientist\Execution::class,
            'fields' => [
                'name'         => 'name',
                'start_time'   => 'start_time',
                'end_time'     => 'end_time',
                'time'     => '',
                'start_memory' => 'start_memory',
                'end_memory'   => 'end_memory',
                'memory' => '',
                'match'        => 'match',
                'result'        => 'result',
            ],
        ],

    ],

    'reporters' =>[
        Jampot5000\EloquentScientist\EloquentJournal::class,
    ]
];