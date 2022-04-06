<?php

namespace Core\Models\DbFramework\Dbo;

class Product extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.Product';
    protected $primaryKey = 'idProduct';

    protected $fillable = [
        'idProduct','txCode','txDescription','obImage','inStatus','txFeature','txComplement','inFree','nuGrade','idFollowUp','idDiscipline','inAppStore','txPath'
    ];

}
