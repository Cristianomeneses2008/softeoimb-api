<?php

namespace Core\Models\DbFramework\Dbo;

class SystemCatalog extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.SystemCatalog';
    protected $primaryKey = 'idSystem';

    protected $fillable = [
        'idSystem', 'txSystemName', 'txSystemDescription', 'txSystemUrl', 'txSystemPath', 'txClientName', 'txClientId',
        'txRedirectUris', 'txPostLogoutRedirectUris', 'inEnabled', 'txAccessTokenType', 'txFlow', 'txClientSecret',
        'inDefaultSystem', 'idExternalProvider'
    ];

}
