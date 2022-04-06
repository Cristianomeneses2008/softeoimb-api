<?php

namespace Core\Models\DbSchool\Dbo;

class ExamTakenStatus extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamTakenStatus';
    protected $primaryKey = 'idExamTakenStatus';

    protected $fillable = [
        'idExamTakenStatus', 'txExamTakenStatus','dtInserted'
    ];
}
