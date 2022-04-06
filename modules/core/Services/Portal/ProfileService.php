<?php

namespace Core\Services\Portal;

use Core\Constants\AccountType;
use Core\Constants\EntityType;
use Core\Constants\Perfis;
use Core\Models\DbFramework\Dbo\EntityUser;
use Core\Models\DbFramework\Dbo\User;
use Core\Models\DbFramework\Dbo\UserProfile;

class ProfileService
{
    public function retornarPerfisPorUsuarioSistema($idUser, $idSystem=null, $codProfile= null)
    {
        $sql = UserProfile::query()
            ->join('dbFramework.dbo.Profile as p', 'dbFramework.dbo.UserProfile.idProfile', '=', 'p.idProfile')
            ->join('dbFramework.dbo.SystemCatalog as sc', 'dbFramework.dbo.UserProfile.idSystem', '=', 'sc.idSystem')
            ->where('dbFramework.dbo.UserProfile.idUser', $idUser)
            ->select([  'dbFramework.dbo.UserProfile.idUser',
                        'p.idProfile',
                        'p.txProfileName',
                        'p.txCode',
                        'sc.idSystem',
                        'sc.txSystemName']);

        if($idSystem) {
            $sql->where('sc.idSystem', $idSystem);
        }

        if($codProfile){
            $sql->where('p.txCode', 'LIKE', '%'.$codProfile.'%');
        }
        return $sql->get();
    }

    public function retornarPerfilPorUsuario($perfis)
    {
        $gestao = array_merge(Perfis::COD_GESTORES, Perfis::COD_COORDENADOR, Perfis::COD_DIRETORES);

        $admin = array_intersect($perfis, Perfis::COD_ADMINISTRADOR);
        $gestor = array_intersect($perfis, $gestao);

        if(count($gestor) > 0 && count($admin) > 0){
            return 'gestorAdmin';
        }

        if(count($admin) > 0){
            return 'admin';
        }

        if(count($gestor) > 0){
            return 'gestor';
        }

        $professor = array_intersect($perfis, Perfis::COD_PROFESSORES);
        if(count($professor) > 0){
            return 'professor';
        }

        $aluno = array_intersect($perfis, Perfis::COD_ALUNOS);
        if (count($aluno) > 0){
            return 'aluno';
        }

        return 'aluno';
    }

    public function retornarPerfil($idUser) {
        $perfis = $this->retornarPerfisPorUsuarioSistema($idUser)->pluck('txCode')->toArray();
        return $this->retornarPerfilPorUsuario($perfis);
    }

    public function getDetalheAlunoProfessor($idUser)
    {
        $sql = User::query()
            ->join('dbFramework.dbo.EntityUser as eu', 'eu.idUser', '=', 'dbFramework.dbo.User.idUser')
            ->join('dbFramework.dbo.Entity as turma', 'eu.idEntity', '=', 'turma.idEntity')
            ->join('dbFramework.dbo.Entity as serie', 'serie.idEntity', '=', 'turma.idEntityReference')
            ->join('dbFramework.dbo.Entity as segmento', 'segmento.idEntity', '=', 'serie.idEntityReference')
            ->join('dbFramework.dbo.Entity as ano', 'ano.idEntity', '=', 'segmento.idEntityReference')
            ->join('dbFramework.dbo.Entity as escola', 'escola.idEntity', '=', 'ano.idEntityReference')
            ->join('dbFramework.dbo.Entity as mantenedora', 'mantenedora.idEntity', '=', 'escola.idEntityReference')
            ->join('dbFramework.dbo.SalesCampaign as sc', 'sc.txYear', '=', 'eu.txSchoolYear')
            ->join('dbSchool.dbo.Account as aturma', 'aturma.idUser', '=', 'turma.idEntity')
            ->where('eu.inStatus', 1)
            ->where('sc.inStatus', 1)
            ->where('sc.inStatusSchool', 1)
            ->where('turma.idEntityType', EntityType::ID_TURMA)
            ->where('dbFramework.dbo.User.idUser', $idUser)
            ->where('aturma.idAccountType', AccountType::TURMA)
            ->select([
                'turma.idEntity as idEntityTurma', 'turma.idEntityType as idEntityTypeTurma', 'turma.txName as txNameTurma', 'turma.txDescription as txDescriptionTurma', 'aturma.idAccount as idAccountTurma',
                'serie.idEntity as idEntitySerie', 'serie.idEntityType as idEntityTypeSerie', 'serie.txName as txNameSerie', 'serie.txDescription as txDescriptionSerie',
                'segmento.idEntity as idEntitySegmento', 'segmento.idEntityType as idEntityTypeSegmento', 'segmento.txName as txNameSegmento', 'segmento.txDescription as txDescriptionSegmento',
                'ano.idEntity as idEntityAno', 'ano.idEntityType as idEntityTypeAno', 'ano.txName as txNameAno', 'ano.txDescription as txDescriptionAno',
                'escola.idEntity as idEntityEscola', 'escola.idEntityType as idEntityTypeEscola', 'escola.txName as txNameEscola', 'escola.txDescription as txDescriptionEscola',
                'mantenedora.idEntity as idEntityMantenedora', 'mantenedora.idEntityType as idEntityTypeMantenedora', 'mantenedora.txName as txNameMantenedora', 'mantenedora.txDescription as txDescriptionMantenedora']);
            return $sql->first();
    }

    /**
     * @param $idUser
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function retornarTurmaAluno($idUser) {
        return EntityUser::query()
            ->join('dbFramework.dbo.SalesCampaign as sc', 'sc.txYear', '=', 'dbFramework.dbo.EntityUser.txSchoolYear')
            ->join('dbSchool.dbo.Account as a', 'a.idUser', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->join('dbFramework.dbo.vw_Entity as ve', 've.idEntityClass', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->where('sc.inStatus', 1)
            ->where('sc.inStatusSchool', 1)
            ->where('dbFramework.dbo.EntityUser.inStatus', 1)
            ->where('dbFramework.dbo.EntityUser.idUser', $idUser)
            ->where('a.idAccountType', AccountType::TURMA)
            ->select(['dbFramework.dbo.EntityUser.idUser',
                        'a.idAccount as idAccountTurma',
                        'a.idAccountType',
                        've.*'
                ])->first();
    }
}
