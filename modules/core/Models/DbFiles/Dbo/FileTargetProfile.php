<?php

namespace Core\Models\DbFiles\Dbo;

use Core\Models\DbFramework\Dbo\Profile;
use Core\Models\DbFramework\Dbo\SystemCatalog;
use Core\Models\DbSchool\Dbo\Account;

class FileTargetProfile extends AbstractModel
{
    protected $table = 'dbo.FileAccountTarget';
    protected $primaryKey = 'idFileTargetProfile';

    protected $fillable = [
        'idFileTargetProfile', 'idFile', 'idSystem', 'idProfile', 'inStatus','dtIncluded', 'dtUpdated'
    ];

    public function files()
    {
        return $this->hasMany(Files::class, 'idFile', 'idFile');
    }

    public function system()
    {
        return $this->hasOne(SystemCatalog::class, 'idSystem', 'idSystem');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'idProfile', 'idProfile');
    }
}
