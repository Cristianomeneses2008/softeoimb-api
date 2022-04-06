<?php

namespace Core\Models\DbFramework\Dbo;

class EntityDiscipline extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.EntityDiscipline';

    protected $fillable = [
         'idDiscipline', 'idEntity', 'txCode', 'txName', 'nuGroupCode'
    ];
}
