<?php

namespace Core\Models\DbSchool\Dbo;

class ExamVersion extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.ExamVersion';
    protected $primaryKey = 'idExamVersion';


    protected $fillable = [
        'idExamVersion', 'idExam', 'nuVersion', 'txNotes', 'nuTimeLimit', 'nuRetryLimit', 'inRandomizeQuestionType', 'inGradeDistribution',
        'idAnswerTemplateType', 'inEnabled', 'dtGradeRelease', 'dtCreated', 'dtLastUpdate', 'inVideoConference', 'inApplicationMode',
        'dtProcessingTRI', 'inExamBlockWindow', 'inContinueExam'
    ];

    public function ExamQuestions()
    {
        return $this->hasMany(ExamQuestions::class, 'idExamVersion', 'idExamVersion');
    }

    public function examSettings()
    {
        return $this->hasMany(ExamSettings::class, 'idExamVersion', 'idExamVersion');
    }

    public function eventActivity()
    {
        return $this->hasMany(EventActivity::class, 'idExamVersion', 'idExamVersion');
    }
}
