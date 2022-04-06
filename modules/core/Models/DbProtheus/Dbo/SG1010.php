<?php

namespace Core\Models\DbProtheus\Dbo;

class SG1010 extends AbstractModel
{
    public $timestamps = false;
    protected $connection = 'sqlsrv_dbProtheus';
    protected $table = 'dbo.SG1010';
    protected $primaryKey = 'R_E_C_N_O_';

    protected $fillable = [
        'G1_FILIAL','G1_COD','G1_COMP','G1_TRT','G1_QUANT','G1_PERDA','G1_INI','G1_FIM','G1_OBSERV','G1_FIXVAR',
        'G1_GROPC','G1_OPC','G1_REVINI','G1_REVFIM','G1_NIV','G1_NIVINV','G1_POTENCI','G1_VECTOR','G1_VLCOMPE',
        'G1_TIPVEC','G1_OK','D_E_L_E_T_','R_E_C_N_O_','R_E_C_D_E_L_','G1_XEDEBE','G1_XPAI'
    ];

}
