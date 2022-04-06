<?php

namespace Core\Models\DbSchool\Dbo;

use Illuminate\Support\Facades\Log;

class ExamTaken extends AbstractModel
{
    use \Awobaz\Compoships\Compoships;
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamTaken';
    protected $primaryKey = 'idExamTaken';

    protected $fillable = [
        'idExamTaken', 'idExamVersion', 'idAccount', 'idExamTakenStatus', 'idEvent', 'dtSchedule', 'dtStart', 'nuTimeSpan',
        'nuAnsweredQuestions', 'nuBlankQuestions', 'nuTotalScore', 'txPathAnswerSheet', 'txURLCorrection', 'dtAnswerSheetUploaded',
        'idAccountUploaded', 'dtUpdateStatus', 'dtRestartExam', 'idAccountRestartExam', 'nuRestartAttempts', 'idDisciplineForeignLanguage'
    ];

    public function ExamTakenQuestions()
    {
        return $this
            ->hasMany(ExamTakenQuestions::class, 'idExamTaken', 'idExamTaken')
            ->where('idExamVersion', $this->idExamVersion);
    }

    public function ExamVersion()
    {
        return $this->hasOne(ExamVersion::class, 'idExamVersion', 'idExamVersion');
    }

    public function ExamTakenAnswers()
    {
        return $this
            ->hasMany(ExamTakenAnswers::class, 'idExamTaken', 'idExamTaken')
            ->where('idExamVersion', $this->idExamVersion);
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'idAccount', 'idAccount');
    }

    public function eventActivity()
    {
        return $this->belongsTo(EventMembers::class, ['idEvent','idAccount'], ['idEvent','idAccount']);
    }
}
