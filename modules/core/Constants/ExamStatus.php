<?php

namespace Core\Constants;
/**
 * Class ExamStatus
 * @package Core\Constants
 * Essas constantes não constam no banco de dados, criamos para utilização de status para
 * gestores e adminsitradores do sistema filtrar por determinado status suas provas
 *
 *  Rascunho = não tem agendamento
 *  Agendada = tem agendamento mas ainda não chegou a data
 *  Em realização = ta dentro do range de datas
 *  Realizada = passou da data final do agendamento
 *  Minhas = Avaliaçãos criadas pelo usuário logado (apenas para gestor e administrador)
 */
class ExamStatus
{
    CONST AGENDADAS = 'AGE';
    CONST EM_REALIZACAO = 'EMR';
    CONST REALIZADA = 'REA';
    CONST RASCUNHO = 'RAS';
    CONST MINHAS = 'MIN';
}
