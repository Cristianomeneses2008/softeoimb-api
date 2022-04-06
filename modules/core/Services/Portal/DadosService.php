<?php

namespace Core\Services\Portal;

use Core\Constants\AccountType;
use Core\Constants\EntityType;
use Core\Models\DbFramework\Dbo\EntityUser;
use Core\Models\DbFramework\Dbo\User;
use Core\Models\DbSchool\Dbo\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DadosService
{
    public function retornarEscolasPorUsuario()
    {
        $profileService = new ProfileService();
        if ($profileService->retornarPerfil(auth()->user()->idUser) === 'admin' || $profileService->retornarPerfil(auth()->user()->idUser) === 'gestorAdmin'){
            $sql = User::query()
                ->join('dbFramework.dbo.EntityUser as eu', 'eu.idUser', '=', 'dbFramework.dbo.User.idUser')
                ->join('dbFramework.dbo.Entity as e', 'e.idEntity', '=', 'eu.idEntity')
                ->join('dbFramework.dbo.Entity as ef', 'ef.idEntity', '=', 'e.idEntityReference')
                ->join('dbSchool.dbo.Account as a', 'e.idEntity', '=', 'a.idUser')
                ->select([
                    'ef.txCode as CodMantenedora',
                    'e.idEntityReference as idMantenedora',
                    'ef.txName as Mantenedora',
                    'e.idEntity as idEscola',
                    'a.idAccount as idAccountEscola',
                    'e.txName as Escola'])
                ->where('eu.inStatus', 1)
                ->where('e.idEntityType', EntityType::ID_ESCOLA)
                ->where('dbFramework.dbo.User.idUser', auth()->user()->idUser);

            $result = $sql->get();
            if($result->count() <= 0){
                $sql = EntityUser::query()
                    ->join('dbFramework.dbo.vw_Entity as en', 'en.idEntityClass', '=', 'dbFramework.dbo.EntityUser.idEntity')
                    ->join('dbFramework.dbo.User as u', 'u.idUser', '=', 'dbFramework.dbo.EntityUser.idUser')
                    ->join('dbFramework.dbo.SalesCampaign as sc', 'sc.txYear', '=', 'dbFramework.dbo.EntityUser.txSchoolYear')
                    ->join( 'dbFramework.dbo.Entity as ef','ef.txCode', '=','en.txCodeMaintainer')
                    ->join('dbSchool.dbo.Account as a', 'en.idEntitySchool', '=', 'a.idUser')
                    ->where('sc.inStatus', 1)
                    ->where('sc.inStatusSchool', 1)
                    ->where('dbFramework.dbo.EntityUser.inStatus', 1)
                    ->select([
                        'en.txCodeMaintainer as CodMantenedora',
                        'ef.idEntity as idMantenedora',
                        'en.txMaintainer as Mantenedora',
                        'en.idEntitySchool as idEscola',
                        'a.idAccount as idAccountEscola',
                        'en.txSchool as Escola'])
                ->groupBy(['en.txCodeMaintainer', 'ef.idEntity',  'en.txMaintainer', 'en.idEntitySchool', 'en.txSchool'])
                ->orderByRaw('cast([en].[txCodeMaintainer] as integer) asc');
                $result = $sql->get();
            }
        } else {
            $sql = User::query()
                ->join('dbFramework.dbo.EntityUser as eu', 'eu.idUser', '=', 'dbFramework.dbo.User.idUser')
                ->join('dbFramework.dbo.Entity as e', 'e.idEntity', '=', 'eu.idEntity')
                ->join('dbFramework.dbo.Entity as ef', 'ef.idEntity', '=', 'e.idEntityReference')
                ->join('dbSchool.dbo.Account as a', 'e.idEntity', '=', 'a.idUser')
                ->select([
                    'ef.txCode as CodMantenedora',
                    'e.idEntityReference as idMantenedora',
                    'ef.txName as Mantenedora',
                    'e.idEntity as idEscola',
                    'a.idAccount as idAccountEscola',
                    'e.txName as Escola'])
                ->where('eu.inStatus', 1)
                ->where('e.idEntityType', EntityType::ID_ESCOLA)
                ->where('dbFramework.dbo.User.idUser', auth()->user()->idUser);
                $result = $sql->get();
        }

        return $result;
    }

    public function retornarTurmas($tipoPerfil, $idEscola = null, $students = false)
    {
        if($students) {
            $sql = EntityUser::with(['entity.users.account'], function(Builder $query){
                $query->where('inStatus', 1);
            });
        }else{
            $sql = EntityUser::query();
        }

        $sql->distinct()
            ->join('dbFramework.dbo.vw_Entity as en', 'en.idEntityClass', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->join('dbFramework.dbo.User as u', 'u.idUser', '=', 'dbFramework.dbo.EntityUser.idUser')
            ->join('dbFramework.dbo.SalesCampaign as sc', 'sc.txYear', '=', 'dbFramework.dbo.EntityUser.txSchoolYear')
            ->join('dbSchool.dbo.Account as a', 'a.idUser', '=', 'en.idEntityClass')
            ->where('sc.inStatus', 1)
            ->where('sc.inStatusSchool', 1)
            ->where('dbFramework.dbo.EntityUser.inStatus', 1)
            ->where('a.idAccountType', 4)
            ->select(['a.idAccount', 'en.idEntitySchool', 'en.idEntityClass', 'en.idEntityGrade',
                'en.txSegment', 'en.txGradeDescription', 'en.txClass', 'dbFramework.dbo.EntityUser.idEntity']);

        if($tipoPerfil == 'professor'){
            $sql->where('u.idUser', auth()->user()->idUser);
        }

        if($idEscola) {
            if(!is_array($idEscola)){
                $sql->where('en.idEntitySchool', $idEscola);
            } else{
                $sql->whereIn('en.idEntitySchool', $idEscola);
            }
        }

        $sql->orderBy('en.TxSegment');
        $sql->orderBy('en.txGradeDescription');

        return $sql->get();
    }

    public function retornarUsuariosPorString($string, $idSchool = null, $idFile = null)
    {
        $profileService = new ProfileService();
        $tipoPerfil = $profileService->retornarPerfil(auth()->user()->idUser);
        if($tipoPerfil == 'aluno') {
            return [];
        }

        if(($tipoPerfil == 'admin' || $tipoPerfil == 'gestorAdmin') && (!$idSchool || $idSchool == 'null')) {
            $sql = "select DISTINCT top 20
                    a.txScreenName,
                    u.idUser,
                    u.txSSOLoginName,
                    u.txFirstName,
                    u.txLastName,
                    u.txFullName,
                    eu.txProfileName,
                    e.txSegment,
                    a.idAccount,
                    e.idEntityClass,
                    e.idEntityGrade,
                    e.txGradeDescription,
                    e.txClass ,
                    eu.txSchoolYear,
                    e.idEntitySchool 
                    from dbFramework.dbo.[User] u 
                    join dbSchool.dbo.Account a
                    on a.idUser = u.idUser 
                    left join [dbFramework].[dbo].[EntityUser] eu 
                    on u.idUser = eu.idUser and eu.inStatus = 1 
                    left join dbFramework.dbo.vw_Entity e
                    on e.idEntityClass = eu.[idEntity]
                    where exists ( select 1 from dbFramework.dbo.SalesCampaign where inStatus = 1 and inStatusSchool = 1 and txYear = ISNULL(eu.txSchoolYear, YEAR(SYSDATETIME())))
                    and a.txScreenName is not null 
                    and a.txScreenName != ''
                    and (a.txScreenName like '".$string."%'
                    or u.txSSOLoginName like '".$string."%')";

            if($idFile) {
                $sql .= " and a.idAccount not in (select idAccount from dbFiles.dbo.FileAccountTarget where idFile = ".$idFile.")";
            }
        } else{
            $sql = "WITH turmas as (
                   select sc.txYear, en.idEntitySchool, en.idEntityClass, en.idEntityGrade, en.txSegment, en.txGradeDescription, en.txClass 
                          from [dbFramework].[dbo].[EntityUser] as eu
                          join dbFramework.dbo.vw_Entity en on en.idEntityClass = eu.[idEntity]
                          join dbFramework.dbo.[User] u on u.idUser = eu.idUser 
                          join dbFramework.dbo.Entity ef on ef.txCode = en.txCodeMaintainer 
                          join dbFramework.dbo.SalesCampaign sc on sc.txYear = eu.txSchoolYear 
                          where eu.inStatus = 1
                           and sc.inStatus = 1
                           and sc.inStatusSchool = 1 ";

            if($tipoPerfil == 'professor') {
                $sql .= " and eu.idUser = ".auth()->user()->idUser.") ";
            } else {
                $sql .= " and en.[idEntitySchool] =". $idSchool . ") ";
            }

            $sql .= " select DISTINCT top 20 
                                u2.idUser,
                                u2.txSSOLoginName,
                                u2.txFirstName,
                                u2.txLastName,
                                u2.txFullName, 
                                eu2.txProfileName, 
                                a.idAccount, 
                                a.txScreenName,
                                t.idEntityClass, t.idEntityGrade, t.txSegment, t.txGradeDescription, t.txClass
                            from [dbFramework].[dbo].[EntityUser] eu2
                            join turmas t on t.idEntityClass = eu2.[idEntity] and t.txYear = eu2.txSchoolYear 
                            join dbFramework.dbo.[User] u2 on u2.idUser = eu2.idUser
                            join dbSchool.dbo.Account a on a.idUser = u2.idUser 
                                where  (a.txScreenName like '".$string."%' 
                                        or u2.txSSOLoginName like '".$string."%')";

            if($idFile) {
                $sql .= " and a.idAccount not in (select idAccount from dbFiles.dbo.FileAccountTarget where idFile = ".$idFile.")";
            }

            $sql .= " ORDER BY a.txScreenName ";
        }

        return DB::connection('sqlsrv_dbFramework')->select($sql);
    }

    /**
     * @param $idTurma
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function retornarUsuariosDaTurma($idTurma)
    {
        $sql = EntityUser::query()
            ->join('dbFramework.dbo.User as u', 'u.idUser', '=', 'dbFramework.dbo.EntityUser.idUser')
            ->join('dbSchool.dbo.Account as a', 'a.idUser', '=', 'u.idUser')
            ->join('dbSchool.dbo.Account as aTurma', 'aTurma.idUser', '=', 'dbFramework.dbo.EntityUser.idEntity')
            ->where('dbFramework.dbo.EntityUser.inStatus', 1)
            ->where('aTurma.idAccount', $idTurma)
            ->select(['u.idUser', 'a.idAccount', 'u.txFirstName', 'u.txLastName', 'u.txFullName', 'u.txSSOLoginName',
                'dbFramework.dbo.EntityUser.txProfileName', 'a.txScreenName'])
            ->orderBy('dbFramework.dbo.EntityUser.txProfileName', 'asc')
            ->orderBy('a.txScreenName');

        return $sql->get();
    }

    public function countMembersOfClass($idAccount) {
        $account = Account::find($idAccount);
        $count = 0;
        if($account->idAccountType == AccountType::TURMA) {
            $count = DB::connection('sqlsrv_dbSchool')
                ->table('dbSchool.dbo.Account as aClass')
                ->join('dbFramework.dbo.User as u', 'u.idUser', '=', 'aClass.idUser')
                ->join('dbFramework.dbo.EntityUser as eu', 'eu.idEntity', '=', 'u.idUser')
                ->join('dbFramework.dbo.User as uAluno', 'uAluno.idUser', '=', 'eu.idUser')
                ->join('dbSchool.dbo.Account as aAluno', 'uAluno.idUser', '=', 'aAluno.idUser')
                ->where('aClass.idAccount', $idAccount)
                ->where('aClass.idAccountType', AccountType::TURMA)
                ->count();
        }

        return $count;
    }
}
