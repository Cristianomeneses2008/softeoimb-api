<?php

namespace Core\Models\DbSchool\Dbo;

class Questions extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Questions';
    protected $primaryKey = 'idQuestion';

    // protected $fillable = [];

    public function Answers()
    {
        return $this->hasMany(Answers::class, 'idQuestion', 'idQuestion');
    }

    public function QuestionsDiscipline()
    {
        return $this->hasMany(QuestionsDiscipline::class, 'idQuestion', 'idQuestion');
    }

    public function QuestionType()
    {
        return $this->hasOne(QuestionType::class, 'idQuestionType', 'idQuestionType');
    }
}
