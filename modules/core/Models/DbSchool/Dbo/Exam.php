<?php

namespace Core\Models\DbSchool\Dbo;

class Exam extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Exam';
    protected $primaryKey = 'idExam';

    protected $fillable = [
        'idExam','idAccountCreator','idExamType','txExamName','txExamDescription','dtCreated','dtDeleted','idAccountDeleted','dtInserted'
    ];

    public function examType()
    {
        return $this->hasOne(ExamType::class, 'idExamType', 'idExamType');
    }

    public function examVersion()
    {
        return $this->belongsTo(ExamVersion::class, 'idExam', 'idExam');
    }

    public function creator()
    {
        return $this->hasOne(Account::class, 'idAccount', 'idAccountCreator');
    }

}
