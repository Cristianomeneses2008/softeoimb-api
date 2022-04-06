<?php

namespace Core\Models\DbSchool\Dbo;

class EventPracticeTest extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.EventPracticeTest';
    protected $primaryKey = 'idEventPracticeTest';


    protected $fillable = [
        'idEventPracticeTest', 'idExamVersion', 'idEvent', 'idPeriodPracticeTest'
    ];
}
