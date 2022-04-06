<?php

namespace Core\Models\DbSchool\Dbo;

use Core\Constants\AccountType;
use Core\Services\Portal\DadosService;
use Illuminate\Support\Facades\DB;
use League\Event\Event;

class EventMembers extends AbstractModel
{
    use \Awobaz\Compoships\Compoships;
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.EventMembers';

    protected $fillable = [
        'idEvent','idAccount','inOrganizer','dtInviteSent','dtAccepted','idEventMemberStatus','idDisciplineForeignLanguage','dtInserted'
    ];

    protected $appends = ['count_members_class'];

    public function account()
    {
        return $this->hasOne(Account::class, 'idAccount', 'idAccount');
    }

    public function examTaken()
    {
        return $this->hasMany(ExamTaken::class, ['idEvent', 'idAccount'], ['idEvent', 'idAccount']);
    }

    public function getAllOfClass()
    {
        return $this->hasMany(Account::class, 'idAccount', 'idAccount')
            ->join('dbFramework.dbo.EntityUser as eu', 'eu.idEntity', '=', 'dbSchool.dbo.Account.idUser')
                ->join('dbFramework.dbo.User as uAluno', 'uAluno.idUser', '=', 'eu.idUser')
                ->join('dbSchool.dbo.Account as aAluno', 'uAluno.idUser', '=', 'aAluno.idUser')
                ->select([
                    'dbSchool.dbo.Account.idAccount',
                    'eu.idUser as idEntity',
                    'aAluno.idAccount as idAccountStudent',
                    'aAluno.txScreenName as txScreenNameStudent',
                    'aAluno.idAccountType as idAccountTypeStudent',
                    'aAluno.idUser as idUserStudent',
                    'eu.txProfileName'
                ]);
    }

    public function getCountMembersClassAttribute()
    {
        return $this->getAllOfClass()->where('txProfileName', 'Aluno')->count();
    }

    public function examTakenClass()
    {
        return $this->hasMany(Account::class, 'idAccount', 'idAccount')
            ->join('dbFramework.dbo.EntityUser as eu', 'eu.idEntity', '=', 'dbSchool.dbo.Account.idUser')
            ->join('dbFramework.dbo.User as uAluno', 'uAluno.idUser', '=', 'eu.idUser')
            ->join('dbSchool.dbo.Account as aAluno', 'uAluno.idUser', '=', 'aAluno.idUser')
            ->leftJoin('dbSchool.dbo.ExamTaken as et', 'et.idAccount', '=', 'aAluno.idAccount')
            ->addSelect(['et.idExamTaken', 'et.idAccount as idAccountStudent', 'dbSchool.dbo.Account.idAccount',
                'et.idExamVersion','et.idExamTakenStatus','et.idEvent','et.dtSchedule','et.dtStart','et.dtFinished','et.nuTimeSpan',
                'et.nuAnsweredQuestions','et.nuBlankQuestions','et.nuTotalScore','et.txPathAnswerSheet','et.txURLCorrection','et.inDeleted',
                'et.dtAnswerSheetUploaded','et.idAccountUploaded','et.dtUpdateStatus','et.dtRestartExam',
                'et.idAccountRestartExam','et.nuRestartAttempts','et.idDisciplineForeignLanguage','et.txSource'])
            ->where('txProfileName', 'Aluno');
    }

}
