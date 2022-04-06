<?php

namespace Core\Models\DbSchool\Dbo;

class EventActivity extends AbstractModel
{
    use \Awobaz\Compoships\Compoships;
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.EventActivity';
    protected $primaryKey = 'idEventActivity';

    protected $fillable = [
        'idEventActivity','idEvent','idExamVersion','inDeleted','dtInserted'
    ];

    public function event()
    {
        return $this->hasOne(Events::class, 'idEvent', 'idEvent');
    }

    public function examVersion() {
        return $this->hasMany(ExamVersion::class, 'idExamVersion', 'idExamVersion');
    }

    public function examTaken() {
        return $this->hasMany(ExamTaken::class, ['idEvent', 'idExamVersion'], ['idEvent', 'idExamVersion']);
    }

}
