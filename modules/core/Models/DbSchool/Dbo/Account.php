<?php

namespace Core\Models\DbSchool\Dbo;

use Core\Constants\AccountType;
use Core\Models\DbFramework\Dbo\EntityUser;
use Core\Models\DbFramework\Dbo\User;
use Core\Models\DbFramework\Dbo\VwEntity;

class Account extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Account';
    protected $primaryKey = 'idAccount';

    protected $fillable = [
        'idAccount', 'idUser', 'idAccountType', 'txScreenName', 'txURLName', 'txEmail', 'txUsername', 'dtLastAccess',
        'txLanguage', 'dtMemberSince', 'obAccountPhoto', 'inBlocked', 'inCensored', 'inGenneraSync', 'dtLastSync'
    ];

    protected $hidden = [
        'txLanguage', 'dtMemberSince', 'obAccountPhoto', 'inBlocked', 'inCensored', 'inGenneraSync', 'dtLastSync'
    ];

    protected $casts = [
        'idAccount' => 'integer',
        'idUser' => 'integer',
        'idAccountType' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function examTaken() {
        return $this->hasMany(ExamTaken::class, 'idAccount', 'idAccount');
    }

    public function classStudent() {
        return $this->hasOne(EntityUser::class, 'idUser', 'idUser')
            ->join('dbFramework.dbo.SalesCampaign as sc', 'dbFramework.dbo.EntityUser.txSchoolYear', '=', 'sc.txYear')
            ->join('dbFramework.dbo.vw_Entity as ve', 've.idEntityClass', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->join('dbSchool.dbo.Account as a', 'a.idUser', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->where('sc.inStatus', 1)
            ->where('sc.inStatusSchool', 1)
            ->where('a.idAccountType', AccountType::TURMA)
            ->select(['ve.*', 'a.idAccount as idAccountClass']);

    }

}
