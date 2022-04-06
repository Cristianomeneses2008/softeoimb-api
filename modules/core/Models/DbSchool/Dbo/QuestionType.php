<?php

namespace Core\Models\DbSchool\Dbo;

class QuestionType extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.QuestionType';
    protected $primaryKey = 'idQuestionType';

    protected $fillable = [
        'idQuestionType', 'txQuestionType', 'dtInserted'
    ];
}
