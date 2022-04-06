<?php

namespace Core\Models\DbFramework\Dbo;

class SKUControl extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.SKUControl';
    protected $primaryKey = 'idSKUControl';

    protected $fillable = [
        'idSKUControl', 'txTicketSKU','idUser','idProduct','idSKUCluster','dtExpiration','dtClosure','dtInserted'
    ];

}
