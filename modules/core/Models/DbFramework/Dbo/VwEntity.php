<?php

namespace Core\Models\DbFramework\Dbo;

class VwEntity extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.vw_Entity';

    protected $fillable = [
        'txNetwork', 'txCodeNetwork', 'txPole', 'txCodePole', 'txMaintainer', 'txCodeMaintainer', 'txTokenMaintainer',
        'idEntitySchool', 'txSchool', 'txCodeSchool', 'txSchoolYear', 'txCodeSchoolYear', 'txSegment', 'txCodeSegment',
        'idEntityGrade', 'txGrade', 'txGradeDescription', 'txCodeGrade', 'txClass', 'txCodeClass', 'idEntityClass'
    ];

}
