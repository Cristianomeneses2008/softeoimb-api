<?php

namespace Core\Models\DbFiles\Dbo;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $connection = 'sqlsrv_dbFiles';
    protected $schema = 'dbo';

    public $timestamps = false;

}
