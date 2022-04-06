<?php

namespace Core\Models\DbFiles\Dbo;

class ActionType extends AbstractModel
{
    protected $table = 'dbo.ActionType';
    protected $primaryKey = 'coActionType';

    protected $fillable = [
        'coActionType', 'txActionType'
    ];

    protected $casts = [
        'coActionType' => 'integer'
    ];

}
