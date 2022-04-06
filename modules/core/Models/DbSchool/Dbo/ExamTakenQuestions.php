<?php

namespace Core\Models\DbSchool\Dbo;

use \Illuminate\Database\Eloquent\Builder;

class ExamTakenQuestions extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamTakenQuestions';
    protected $primaryKey = ['idExamTaken','idExamVersion','idQuestion'];

    // Por conta de ser uma tabela com mais de uma chave primaria
    public $incrementing = false;

    protected $fillable = [
        'idExamTaken','idExamVersion','idQuestion','txAnswer','inStatus','nuTimeSpan','nuValue',
        'nuDisplayOrder','txComment','dtAnwer','idAccountUploaded','dtInserted', 'dtAnswerUploaded'
    ];

    public function Question()
    {
        return $this->hasOne(Questions::class, 'idQuestion', 'idQuestion');
    }
}
