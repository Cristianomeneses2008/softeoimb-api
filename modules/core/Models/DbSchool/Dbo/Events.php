<?php

namespace Core\Models\DbSchool\Dbo;

class Events extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Events';
    protected $primaryKey = 'idEvent';

    protected $fillable = [
        'idEvent', 'txName','txDetails','txShortDescription','txHotsiteURL','txLocation','nuLatitude','nuLongitude','inPublic','
        inVideoConference','dtStartEvent','dtEndEvent','idEventReference','idEventStatus','idEventType','dtInserted'
    ];

    public function members()
    {
        return $this->hasMany(EventMembers::class, 'idEvent', 'idEvent');
    }

    public function owner()
    {
        return $this->hasOne(EventMembers::class, 'idEvent', 'idEvent')
            ->where('inOrganizer', 1);
    }



}
