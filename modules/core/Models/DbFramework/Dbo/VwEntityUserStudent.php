<?php

namespace Core\Models\DbFramework\Dbo;

class VwEntityUserStudent extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.vw_EntityUserStudent';

    protected $fillable = [
        'idUser', 'idEntity', 'txProfileName'
    ];

}
