<?php

namespace Core\Models\DbFramework\Dbo;

class SKUCluster extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.SKUCluster';
    protected $primaryKey = 'idSKUCluster';

    protected $fillable = [
        'idSKUCluster', 'txClusterSKU'
    ];

}
