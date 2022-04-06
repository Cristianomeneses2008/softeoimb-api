<?php

namespace Core\Models\DbFramework\Dbo;

class Profile extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.Profile';
    protected $primaryKey = 'idProfile';

    protected $fillable = [
        'idProfile', 'idSystem', 'txProfileName', 'txCode'
    ];

}
