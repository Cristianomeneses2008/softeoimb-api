<?php

namespace Core\Models\DbSchool\Dbo;

class PeriodPracticeTest extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.PeriodPracticeTest';
    protected $primaryKey = 'idPeriodPracticeTest';

    protected $fillable = [
        'idPeriodPracticeTest', 'idPeriodSchoolGrade', 'idPracticeTestType', 'nuOrder'
    ];

    protected $casts = [
        'idPeriodSchoolGrade' => 'integer',
        'idPeriodPracticeTest' => 'integer',
        'idPracticeTestType' => 'integer'
    ];

    public function periodSchoolGrade()
    {
        return $this->belongsTo(PeriodSchoolGrade::class, 'idPeriodSchoolGrade', 'idPeriodSchoolGrade');
    }

    public function practiceTestType()
    {
        return $this->hasOne(PracticeTestType::class, 'idPracticeTestType', 'idPracticeTestType');
    }


}
