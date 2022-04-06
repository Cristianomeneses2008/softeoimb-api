<?php

namespace Core\Models\DbFramework\Dbo;

class EntityUser extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.EntityUser';

    protected $fillable = [
         'idEntity', 'idUser', 'dtUpdate', 'inStatus', 'txSchoolYear', 'txProfileName'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'idUser', 'idUser');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class,'idEntity', 'idEntity');
    }

}
