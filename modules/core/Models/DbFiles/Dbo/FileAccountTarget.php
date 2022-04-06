<?php

namespace Core\Models\DbFiles\Dbo;

use Core\Models\DbSchool\Dbo\Account;

class FileAccountTarget extends AbstractModel
{
    protected $table = 'dbo.FileAccountTarget';

    protected $fillable = [
        'idFile', 'idAccount', 'dtShared'
    ];

    public function files()
    {
        return $this->hasMany(Files::class, 'idFile', 'idFile');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'idAccount', 'idAccount');
    }
}
