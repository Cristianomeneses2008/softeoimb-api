<?php

namespace Core\Models\DbSchool\Dbo;

use Core\Models\DbFramework\Dbo\User;

class VwUserEntity extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.vw_UserEntity';
    protected $primaryKey = 'idPeriodPracticeTest';

    protected $fillable = [
        'idUser', 'idEntitySchool', 'idAccountSchool', 'txBrandName'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function accountSchool()
    {
        return $this->belongsTo(Account::class, 'idAccountSchool', 'idAccountSchool');
    }

}
