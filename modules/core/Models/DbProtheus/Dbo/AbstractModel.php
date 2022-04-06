<?php

namespace Core\Models\DbProtheus\Dbo;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{

    protected $schema = 'dbo';

    public $timestamps = false;

}
