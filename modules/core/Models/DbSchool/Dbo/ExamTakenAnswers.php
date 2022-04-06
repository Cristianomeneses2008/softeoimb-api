<?php

namespace Core\Models\DbSchool\Dbo;

class ExamTakenAnswers extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamTakenAnswers';
    protected $primaryKey = 'idExamTakenAnswers';

    protected $fillable = ['idExamTakenAnswers','idExamTaken','idExamVersion','idQuestion','idAnswer','inStatus','dtInserted'];
}
