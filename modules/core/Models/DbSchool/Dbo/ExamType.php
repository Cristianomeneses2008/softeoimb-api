<?php

namespace Core\Models\DbSchool\Dbo;

class ExamType extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamType';
    protected $primaryKey = 'idExamType';

    protected $fillable = [
        'idExamType','txExamType','dtInserted'
    ];
}
