<?php

namespace Core\Models\DbFiles\Dbo;

class AuditAccess extends AbstractModel
{
    protected $table = 'dbo.AuditAccess';
    protected $primaryKey = 'idAccess';

    protected $fillable = [
        'idAccess', 'dtAccess', 'idFile', 'idAccount', 'coActionType'
    ];

    protected $casts = [
        'idAccess' => 'integer',
        'idAccount' => 'integer',
        'coActionType' => 'integer',
        'idFile' => 'integer',
    ];

}
