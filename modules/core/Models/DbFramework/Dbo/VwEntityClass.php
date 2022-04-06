<?php

namespace Core\Models\DbFramework\Dbo;

class VwEntityClass extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.vw_EntityClass';

    protected $fillable = [
        'idEntitySchool','idEntityYear','txSchoolYear','txCodeSchoolYear','idEntitySegment','txSegment','txCodeSegment',
        'idEntityGrade','txGrade','txGradeDescription','txCodeGrade','idEntityClass','txClass','txCodeClass'
    ];
}
