<?php

namespace Core\Models\DbSchool\Dbo;

class Answers extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Answers';
    protected $primaryKey = 'idAnswer';

    // protected $fillable = [];
}
