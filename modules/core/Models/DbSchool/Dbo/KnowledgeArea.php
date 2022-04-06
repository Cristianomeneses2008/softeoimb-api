<?php

namespace Core\Models\DbSchool\Dbo;

class KnowledgeArea extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.KnowledgeArea';
    protected $primaryKey = 'idKnowledgeArea';

    protected $fillable = [
        'txKnowledgeArea','txShortName','txCSSColor','dtInserted'
    ];

}
