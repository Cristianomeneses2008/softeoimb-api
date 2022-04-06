<?php

namespace Core\Models\DbProtheus\Dbo;

class SC5010 extends AbstractModel
{
    protected $connection = 'sqlsrv_dbProtheus';

    public $timestamps = false;
    protected $table = 'dbo.SC5010';
    //protected $primaryKey = 'idAccount';

    protected $fillable = [
        'C5_FILIAL','C5_NUM','C5_TIPO','C5_CLIENTE','C5_LOJACLI','C5_CLIENT','C5_LOJAENT','C5_TRANSP','C5_TIPOCLI','C5_CONDPAG','C5_TABELA','C5_VEND1',
        'C5_COMIS1','C5_VEND2','C5_COMIS2','C5_VEND3','C5_COMIS3','C5_VEND4','C5_COMIS4','C5_VEND5','C5_COMIS5','C5_DESC1','C5_DESC2','C5_DESC3','C5_DESC4',
        'C5_BANCO','C5_DESCFI','C5_EMISSAO','C5_COTACAO','C5_PARC1','C5_DATA1','C5_PARC2','C5_DATA2','C5_PARC3','C5_DATA3','C5_PARC4','C5_DATA4','C5_TPFRETE',
        'C5_FRETE','C5_SEGURO','C5_DESPESA','C5_FRETAUT','C5_REAJUST','C5_MOEDA','C5_PESOL','C5_PBRUTO','C5_REIMP','C5_REDESP','C5_VOLUME1','C5_VOLUME2','C5_VOLUME3',
        'C5_VOLUME4','C5_ESPECI1','C5_ESPECI2','C5_ESPECI3','C5_ESPECI4','C5_ACRSFIN','C5_MENNOTA','C5_MENPAD','C5_INCISS','C5_LIBEROK','C5_OK','C5_NOTA','C5_SERIE',
        'C5_KITREP','C5_OS','C5_TIPLIB','C5_DESCONT','C5_PEDEXP','C5_TXMOEDA','C5_TPCARGA','C5_DTLANC','C5_PDESCAB','C5_BLQ','C5_FORNISS','C5_CONTRA','C5_VLR_FRT',
        'C5_MDCONTR','C5_MDNUMED','C5_GERAWMS','C5_MDPLANI','C5_SOLFRE','C5_FECENT','C5_SOLOPC','C5_SUGENT','C5_ESTPRES','C5_CODED','C5_NUMPR','C5_ORCRES','C5_RECISS',
        'C5_RECFAUT','C5_MUNPRES','C5_VEICULO','C5_DESCMUN','C5_SERSUBS','C5_NFSUBST','C5_PREPEMB','C5_OBRA','C5_ECSEDEX','C5_ECPRESN','C5_ECVINCU','C5_XMATRIC',
        'C5_XRESPON','C5_XESCOLA','C5_XNFEDEV','C5_XSERDEV','C5_XIDRESP','C5_XNOMEAL','C5_XECPEDC','D_E_L_E_T_','R_E_C_N_O_','R_E_C_D_E_L_','C5_XEXPLOD','C5_USERLGI',
        'C5_USERLGA','C5_XENTREG','C5_XPRTNOM','C5_XPRTEMA','C5_XANOLET','C5_INDPRES','C5_XIDORIG','C5_XTICKET','C5_XRESERV','C5_DTESERV','C5_NATUREZ','C5_NUMECO',
        'C5_NUMECLI','C5_XLOGIST','C5_XTPFRET','C5_XSTATUS','C5_XDTENTR','C5_XNOME','C5_XDOREC','C5_XHIST','C5_XDIGITA','C5_XCOMERC','C5_ORIGEM','C5_NUMENT','C5_MOEDTIT',
        'C5_TXREF','C5_DTTXREF','C5_XNOMECL','C5_XEMAIL','C5_MSBLQL','C5_CODEMB','C5_REMCTR','C5_REMREV','C5_TPCOMPL','C5_TABTRF','C5_SLENVT','C5_RET20G','C5_PLACA2',
        'C5_PLACA1','C5_MODANP','C5_CODVGLP','C5_CODMOT','C5_TIPOBRA','C5_FILGCT','C5_CNO','C5_CODSAF','C5_TRCNUM','C5_PEDECOM','C5_RASTR','C5_STATUS','C5_CGCINT',
        'C5_CLIINT','C5_IMINT','C5_ARTOBRA','C5_NTEMPEN','C5_SDOC','C5_SDOCSUB','C5_VOLTAPS','C5_XADMFIM','C5_XSQORDR','C5_XSQHASH','C5_XSQPEDV','C5_XNUMTRA',
        'C5_XNUMEST','C5_XSQFLUX','C5_XHORAEN','C5_XTESMOV','C5_XSQCLAS','C5_XXML','C5_XSNU','C5_XARMDES','C5_XORCMAN','C5_XHRRE','C5_XDTRE','C5_XBANDEI'

    ];

}