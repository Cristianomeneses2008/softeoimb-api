<?php

namespace Core\Models\DbFramework\Dbo;

class VwUserSponsor extends AbstractModel
{
    protected $connection = 'sqlsrv_dbFramework';

    public $timestamps = false;
    protected $table = 'dbo.vw_UserSponsor';

    protected $fillable = [
        'AlunoIdUser','AlunoLogin','AlunoPrimeiroNome','AlunoSobrenome','AlunoStatus','ResponsavelIdUser',
        'ResponsavelLogin','ResponsavelCPF','ResponsavelPrimeiroNome','ResponsavelSobrenome','ResponsavelStatus'
    ];

    public function aluno()
    {
        return $this->hasOne(User::class, 'idUser', 'AlunoIdUser');
    }

    public function responsavel()
    {
        return $this->hasOne(User::class, 'idUser', 'ResponsavelIdUser');
    }

}
