<?php

namespace Core\Models\DbSchool\Dbo;

class Discipline extends AbstractModel
{
    protected $connection = 'sqlsrv_dbSchool';

    public $timestamps = false;
    protected $table = 'dbo.Discipline';
    protected $primaryKey = 'idDiscipline';

    protected $fillable = [
        'idDiscipline','txDiscipline','coDiscipline','idKnowledgeArea','dtInserted'
    ];

    public function knowledgeArea()
    {
        return $this->hasOne(KnowledgeArea::class, 'idKnowledgeArea', 'idKnowledgeArea');
    }

}
