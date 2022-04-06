<?php

namespace Core\Models\DbSchool\Dbo;

class ExamSettings extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamSettings';
    protected $primaryKey = 'idExamSettings';

    protected $fillable = ['idExamVersion','idDiscipline','nuQuestions','nuTotalScore','inEnable','inAllowOptionForeignLanguage','dtInserted'];


    public function discipline()
    {
        return $this->hasOne(Discipline::class, 'idDiscipline', 'idDiscipline');
    }
}
