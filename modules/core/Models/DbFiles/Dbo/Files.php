<?php

namespace Core\Models\DbFiles\Dbo;

use Core\Models\DbSchool\Dbo\Account;
use File\Services\FileService;

class Files extends AbstractModel
{
    protected $table = 'dbo.Files';
    protected $primaryKey = 'idFile';

    protected $fillable = [
        'idFile', 'idAccountOwner', 'idFileCategory','txTitle', 'txDescription', 'txName', 'txVirtualPath', 'txBucket',
        'txRegion', 'txOriginalName', 'txMimeType', 'dtStartPublish', 'dtEndPublish',  'dtInserted', 'dtDeleted'
    ];

    protected $casts = [
        'idFile' => 'integer',
        'idAccountOwner' => 'integer',
        'idFileCategory' => 'integer',
    ];

    protected $hidden = ['txVirtualPath', 'txBucket', 'txRegion'];

    protected $appends = ['url', 'url_thumb'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'idAccountOwner', 'idAccount');
    }

    public function category()
    {
        return $this->belongsTo(FileCategory::class, 'idFileCategory', 'idFileCategory');
    }

    public function disciplines()
    {
        return $this->hasMany(FileDiscipline::class, 'idFile', 'idFile');
    }

    public function accounts()
    {
        return $this->hasMany(FileAccountTarget::class, 'idFile', 'idFile');
    }

    //------------------------------------------------------------------------------------------------------------------
    // EXTRA ATTRIBUTES
    //------------------------------------------------------------------------------------------------------------------

    public function getUrlAttribute()
    {
        $arquivoService = new FileService();
        return $arquivoService->retornarUrlFile($this);
    }

    public function getUrlThumbAttribute()
    {
        $arquivoService = new FileService();
        return $arquivoService->retornarUrlThumbFile($this);
    }

}
