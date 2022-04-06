<?php

namespace Core\Models\DbFiles\Dbo;

class Configurations extends AbstractModel
{
    protected $table = 'dbo.Configurations';
    protected $primaryKey = 'idConfiguration';

    protected $fillable = [
        'idConfiguration', 'txKey', 'txValue'
    ];

    protected $casts = [
        'idConfiguration' => 'integer'
    ];

}
