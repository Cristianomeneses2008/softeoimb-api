<?php

namespace Core\Models\DbFramework\Dbo;
use Core\Models\DbSchool\Dbo\Account;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    protected $connection = 'sqlsrv_dbFramework';
    use HasApiTokens;

    public $timestamps = false;
    protected $table = 'dbo.User';
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'idUser', 'txSSOLoginName', 'txSSOPassword', 'inStatus', 'obPicture', 'txCPF', 'txFirstName', 'txLastName', 'txFullName', 'dtBirthDate', 'txGenneraCode'
    ];

    protected $hidden = [
        'txSSOPassword'
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'idUser', 'idUser');
    }
}
