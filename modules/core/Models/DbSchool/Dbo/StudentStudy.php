<?php

namespace Core\Models\DbSchool\Dbo;

class StudentStudy extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.StudentStudy';
    protected $primaryKey = 'idPeriodPracticeTest';

    protected $fillable = [
        'idPracticeTestType', 'txPracticeTestType', 'inPracticeTest', 'txCSSImagePracticeType',
        'txCSSImageLearningTrack', 'inFixedFirst', 'inFixedLast'
    ];
}
