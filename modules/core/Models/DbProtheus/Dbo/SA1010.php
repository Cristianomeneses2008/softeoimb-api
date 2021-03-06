<?php

namespace Core\Models\DbProtheus\Dbo;

class SA1010 extends AbstractModel
{
    protected $connection = 'sqlsrv_dbProtheus';

    public $timestamps = false;
    protected $table = 'dbo.SA1010';
    //protected $primaryKey = 'idAccount';

    protected $fillable = [
        'A1_FILIAL','A1_COD','A1_LOJA','A1_PESSOA','A1_NOME','A1_NREDUZ','A1_END','A1_TIPO','A1_EST','A1_ESTADO','A1_COD_MUN','A1_MUN','A1_BAIRRO','A1_IBGE','A1_NATUREZ','
        A1_CEP','A1_DDI','A1_DDD','A1_TEL','A1_TELEX','A1_FAX','A1_ENDCOB','A1_PAIS','A1_ENDREC','A1_ENDENT','A1_CGC','A1_CONTATO','A1_INSCR','A1_PFISICA','A1_INSCRM','A1_VEND','
        A1_COMIS','A1_REGIAO','A1_CONTA','A1_BCO1','A1_BCO2','A1_BCO3','A1_BCO4','A1_BCO5','A1_TRANSP','A1_TPFRET','A1_COND','A1_DESC','A1_PRIOR','A1_RISCO','A1_LC','A1_VENCLC','A1_CLASSE','
        A1_LCFIN','A1_MOEDALC','A1_MSALDO','A1_MCOMPRA','A1_METR','A1_PRICOM','A1_ULTCOM','A1_NROCOM','A1_FORMVIS','A1_TEMVIS','A1_ULTVIS','A1_TMPVIS','A1_TMPSTD','A1_CLASVEN','A1_MENSAGE','
        A1_SALDUP','A1_RECISS','A1_SALPEDL','A1_NROPAG','A1_TRANSF','A1_SUFRAMA','A1_ATR','A1_VACUM','A1_SALPED','A1_TITPROT','A1_DTULTIT','A1_CHQDEVO','A1_MATR','A1_DTULCHQ','A1_MAIDUPL','
        A1_TABELA','A1_INCISS','A1_SALDUPM','A1_PAGATR','A1_CXPOSTA','A1_ATIVIDA','A1_CARGO1','A1_CARGO2','A1_CARGO3','A1_ALIQIR','A1_SUPER','A1_RTEC','A1_OBSERV','A1_RG','A1_CALCSUF','
        A1_DTNASC','A1_SALPEDB','A1_CLIFAT','A1_GRPTRIB','A1_BAIRROC','A1_CEPC','A1_MUNC','A1_ESTC','A1_CEPE','A1_BAIRROE','A1_MUNE','A1_ESTE','A1_SATIV1','A1_SATIV2','A1_CODPAIS','A1_TPESSOA','
        A1_CODLOC','A1_TPISSRS','A1_SATIV3','A1_SATIV4','A1_SATIV5','A1_SATIV6','A1_SATIV7','A1_SATIV8','A1_CODMARC','A1_CODAGE','A1_COMAGE','A1_TIPCLI','A1_EMAIL','A1_DEST_1','A1_DEST_2','
        A1_CODMUN','A1_HPAGE','A1_DEST_3','A1_CBO','A1_CNAE','A1_CONDPAG','A1_DIASPAG','A1_OBS','A1_AGREG','A1_CODHIST','A1_RECINSS','A1_RECCOFI','A1_RECCSLL','A1_RECPIS','A1_TIPPER','A1_SALFIN','
        A1_CONTAB','A1_SALFINM','A1_B2B','A1_GRPVEN','A1_CLICNV','A1_INSCRUR','A1_MSBLQL','A1_SITUA','A1_NUMRA','A1_SUBCOD','A1_CDRDES','A1_FILDEB','A1_CODFOR','A1_ABICS','A1_BLEMAIL','A1_TIPOCLI','
        A1_VINCULO','A1_DTINIV','A1_DTFIMV','A1_LOCCONS','A1_CBAIRRE','A1_CODMUNE','A1_PERFIL','A1_HRTRANS','A1_UNIDVEN','A1_TIPPRFL','A1_PRF_VLD','A1_PRF_COD','A1_REGPB','A1_USADDA','A1_SIMPLES','
        A1_IPWEB','A1_ENDNOT','A1_REGESIM','A1_FRETISS','A1_PERCATM','A1_CODSIAF','A1_CTARE','A1_CEINSS','A1_ABATIMP','A1_FOMEZER','A1_TIMEKEE','A1_TDA','A1_SIMPNAC','A1_FILTRF','A1_CODFID','A1_RECFET','
        A1_MINIRF','A1_COMPLEM','A1_CONTRIB','A1_INCULT','A1_RECIRRF','A1_ORIGEM','A1_ENTID','A1_TPJ','A1_CRDMA','A1_PERFECP','A1_TRIBFAV','A1_PRSTSER','A1_ALIFIXA','A1_RFACS','A1_RFABOV','A1_TPDP','
        A1_OUTRMUN','A1_TPNFSE','A1_ECSEQ','A1_XPOLO','A1_XCODFOR','A1_XLOJFOR','A1_XESALES','A1_XCODESC','A1_IRBAX','A1_INDRET','D_E_L_E_T_','R_E_C_N_O_','R_E_C_D_E_L_','A1_USERLGA','A1_XEMAIL','
        A1_INOVAUT','A1_RECFMD','A1_INCLTMG','A1_XLOCAL','A1_CELULAR','A1_XOBS','A1_XTABATA','A1_XSITCAD','A1_01LJINT','A1_01IDLOJ','A1_01TPLOJ','A1_01DEROY','A1_01DESFP','A1_XNOME','A1_XTEL','
        A1_XEMAILC','A1_PRF_OBS','A1_IDHIST','A1_NIF','A1_MATFUN','A1_IENCONT','A1_DSCREG','A1_HRCAD','A1_DTCAD','A1_CLIPRI','A1_LOJPRI','A1_CODSEG','A1_TPREG','A1_MSEXP','A1_RESERVE','A1_RFASEMT','
        A1_RIMAMT','A1_CODMEMB','A1_CHVCAM','A1_CODTER','A1_USERLGI','A1_ISSRSLC','A1_HREXPO','A1_TPMEMB','A1_RESFAT','A1_NVESTN','A1_IMGUMOV','A1_IDESTN','A1_TPCAMP','A1_ORIGCT','A1_ENTORI'
    ];

}
