<?php

namespace Core\Models\DbFiles\Dbo;

class FileCategory extends AbstractModel
{
    protected $table = 'dbo.FileCategory';
    protected $primaryKey = 'idFileCategory';

    protected $fillable = [
        'idFileCategory', 'txFileCategory'
    ];
}
