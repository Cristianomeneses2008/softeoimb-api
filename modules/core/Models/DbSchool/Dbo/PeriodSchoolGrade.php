<?php

namespace Core\Models\DbSchool\Dbo;


class PeriodSchoolGrade extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.PeriodSchoolGrade';
    protected $primaryKey = 'idPeriodSchoolGrade';

    protected $fillable = [
        'idPeriodSchoolGrade', 'idAccount', 'txSchoolYear', 'idGrade', 'idPeriodType', 'nuPeriod', 'dtStartPeriod', 'dtEndPeriod'
    ];

    protected $casts = [
        'idPeriodSchoolGrade' => 'integer',
        'idAccount' => 'integer',
        'idGrade' => 'integer',
        'idPeriodType' => 'integer',
        'nuPeriod' => 'integer'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'idAccount', 'idAccount');
    }


}
