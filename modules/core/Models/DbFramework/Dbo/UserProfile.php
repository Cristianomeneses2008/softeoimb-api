<?php

namespace Core\Models\DbFramework\Dbo;

class UserProfile extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.UserProfile';

    protected $fillable = [
       'idUser','idSystem','idProfile'
    ];
}
