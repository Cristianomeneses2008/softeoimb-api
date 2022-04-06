<?php

namespace Core\Models\DbFramework\Dbo;

class Entity extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.Entity';
    protected $primaryKey = 'idEntity';

    protected $fillable = [
        'idEntity', 'idEntityType', 'txCode', 'txName', 'txDescription', 'idEntityReference', 'inStatus', 'idEntitySort', 'txCodeIntegration', 'dtInserted'
    ];

    public function  users()
    {
        return $this->belongsToMany(User::class, 'dbo.EntityUser',
            'idEntity', 'idUser');
    }

}
