<?php

namespace Core\Models\DbFiles\Dbo;

use Core\Models\DbSchool\Dbo\Discipline;

class FileDiscipline extends AbstractModel
{
    protected $table = 'dbo.FileDiscipline';

    protected $fillable = [
        'idFile', 'idDiscipline'
    ];

    public function files()
    {
        return $this->hasMany(Files::class, 'idFile', 'idFile');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'idDiscipline', 'idDiscipline');
    }

    public function file()
    {
        return $this->belongsTo(Files::class, 'idFile', 'idFile');
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'idDiscipline', 'idDiscipline');
    }
}
