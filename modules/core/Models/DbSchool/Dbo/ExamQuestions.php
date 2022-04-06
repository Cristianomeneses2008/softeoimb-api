<?php

namespace Core\Models\DbSchool\Dbo;

class ExamQuestions extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamQuestions';
    protected $primaryKey = 'idExamQuestions';

    protected $fillable = [
        'idExamVersion','idQuestion','nuValue','nuDisplay','inVoided','nuBiserial','nuDiscrimination','nuDifficulty','nuPseudoGuessing','dtInserted'
    ];
}
