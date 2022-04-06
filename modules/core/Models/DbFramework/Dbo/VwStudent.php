<?php

namespace Core\Models\DbFramework\Dbo;

class VwStudent extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.vw_Student';

    protected $fillable = [
        'txNetwork', 'txCodeNetwork', 'txPole', 'txCodePole', 'txMaintainer', 'txCodeMaintainer', 'txTokenMaintainer',
        'idEntitySchool', 'txSchool', 'txCodeSchool', 'txSchoolYear', 'txSegment', 'txCodeSegment', 'txGrade',
        'txCodeGrade', 'txGradeDescription', 'idEntityGrade', 'txClass', 'txCodeClass', 'idEntityClass', 'idUser',
        'txUsername', 'txScreenName', 'inGenneraSync', 'txGenneraSync', 'txProfileName', 'txCodeProfile'
    ];

}
