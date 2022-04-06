<?php

namespace Core\Models\DbSchool\Dbo;

class PracticeTestType extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.PracticeTestType';
    protected $primaryKey = 'idPeriodPracticeTest';

    protected $fillable = [
        'idPracticeTestType', 'txPracticeTestType', 'inPracticeTest', 'txCSSImagePracticeType',
        'txCSSImageLearningTrack', 'inFixedFirst', 'inFixedLast'
    ];
}
