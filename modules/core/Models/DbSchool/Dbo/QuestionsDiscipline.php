<?php

namespace Core\Models\DbSchool\Dbo;

class QuestionsDiscipline extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.QuestionsDiscipline';
    protected $primaryKey = 'idQuestion';

    protected $fillable = ['idQuestion','idDiscipline','dtInserted'];
}
