<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Portal\Services\LiberacaoDigitalService;

/**
 * @deprecated migrada para o modulo PORTAL
 * Classe que é chamada por uma cron através do comando
 * php artisan lib-dig-protheus:cron
 * E faz toda integracao entre protheus e o servico da edebe para vincular o produto a venda e disparar o email para
 * o usuario ativar os produtos no portal
 * Class LiberacaoDigitProtheusCron
 * @package App\Console\Commands
 */
class LiberacaoDigitProtheusCronV2 extends Command
{

//    protected $signature = 'lib-dig-protheus:cron {escola?}';
//
//    protected $description = 'Command description';
//
//    protected $service;
//
//    public function __construct()
//    {
//        parent::__construct();
//        $this->service = new LiberacaoDigitalService();
//    }
//
//    /**
//     * @param $txt
//     */
//    private static function log($txt)
//    {
//        Log::channel('cronLibDig')->info($txt);
//    }
//
//    /**
//     * @return array|mixed
//     */
//    private function startTimer()
//    {
//        $mtime = microtime();
//        $mtime = explode(' ', $mtime);
//        $mtime = $mtime[1] + $mtime[0];
//        return $mtime;
//    }
//
//    /**
//     * @param $starttime
//     * @return float
//     */
//    private function endTimer($starttime)
//    {
//        $mtime = microtime();
//        $mtime = explode(' ', $mtime);
//        $mtime = $mtime[1] + $mtime[0];
//        $endtime = $mtime;
//        $totaltime = round(($endtime - $starttime), 5);
//        return $totaltime;
//    }
//
//    /**
//     * @param $produtos
//     * @param $nPedido
//     * @param $log
//     */
//    private function sincronizarProdutos($produtos, $nPedido, &$log)
//    {
//        $produtos->map(function ($produto) use ($nPedido, &$log) {
//            if ($this->service->verificarProdutoExiste(trim($produto->B1_XDIGITA))) {
//                $produto->STATUS_SINC = $this->service->sincronizarApiEdebe($produto);
//                $novoStatus = $produto->STATUS_SINC ? 'S' : 'N';
//                $status = $produto->STATUS_SINC;
//            } else {
//                $produto->STATUS_SINC = false;
//                $status = 'Produto não existe na base do portal.';
//                $novoStatus = '*';
//            }
//
//            $this->info('Produto -> ' . $produto->B1_XDIGITA . ', status -> ' . $status);
//
//            $this->info('update_protheus -> status ' . $novoStatus);
//            $this->service->atualizarStatusProdutoProtheusById($produto->SL2RECNO, $novoStatus);
//
//            //vai criando os itens no array do log
//            array_push($log['produtos'], [
//                'produto' => trim($produto->B1_XDIGITA),
//                'status' => $status
//            ]);
//        });
//    }
//
//    /**
//     * @param $produtos
//     * @param $nPedido
//     * @param $log
//     * @return bool
//     * @throws \Exception
//     */
//    private function enviarEmail($produtos, $nPedido, &$log)
//    {
//        $this->info('Enviando email.');
//
//        $resultNotificacao = $this->service->notificarResponsavelViaSendGrid($nPedido, $produtos);
//
//        if ($resultNotificacao) {
//            $this->info('Enviou e-mail via SendGrid.');
//        }else{
//            //notifica por e-mail padrão
//            $resultNotificacao = $this->service->notificarResponsavel($nPedido, $produtos);
//        }
//
//        //cria nova chave no array do log dizendo se o email foi enviado ou não
//        $log['email'] = $resultNotificacao;
//
//        $this->info('Email -> ' . $resultNotificacao);
//
//        return $resultNotificacao;
//    }
//
//    /**
//     * @param $produtos
//     */
//    private function atualizarStatusParaEmProcessamento($produtos)
//    {
//        $this->info('Atualizando status para em processamento. ' . count($produtos));
//        $this->service->atualizarStatusProdutosProtheus($produtos, 'R');
//    }
//
//    /**
//     * @throws \Exception
//     */
//    public function handle()
//    {
//        $starttime = $this->startTimer();
//        $this->info('Call cron -> ' . $starttime);
//        $escola = [];
//
//        if ($this->argument('escola')) {
//            $escola[] = $this->argument('escola');
//            $this->info('Escola -> ' . $this->argument('escola'));
//        }
//
//        //busca os dados no protheus
//        $dadosProtheus = $this->service->consultarProdutosLiberacaoDigital(100, $escola);
//
//        $logArr = [];//monta o array do log vazio
//        $qtdProdutosSincronizados = 0;
//        $qtdEmailsEnviados = 0;
//
//        if ($dadosProtheus) {
//            //muda o status para em processamento
//            $this->atualizarStatusParaEmProcessamento($dadosProtheus);
//
//            //faz o parse do array para uma collection agrupando por pedido
//            $pedidos = collect($dadosProtheus)->groupBy(function ($item) {
//                return trim($item->L2_XCODLIB);
//            });
//
//            //cria o cabecalho do log
//            array_push($logArr, ['Start' => json_encode([
//                'pedidos' => count($pedidos),
//                'produtos' => count($dadosProtheus)
//            ])]);
//
//            //percorre os pedidos
//            foreach ($pedidos as $nPedido => $produtos) {
//                $this->info($qtdEmailsEnviados . ' -> Pedido -> ' . $nPedido);
//                //cria um array para agrupar os itens percorridos para o log
//                $arrPedidoLog = ['pedido' => $nPedido, 'produtos' => []];
//
//                //percorre os produtos do pedido
//                $this->sincronizarProdutos($produtos, $nPedido, $arrPedidoLog);
//
//                //verifica se tem pelo menos um produto sincronizado com sucesso
//                if ($produtos->contains('STATUS_SINC', true)) {
//                    //pega os produtos sincronizados com sucesso
//                    $produtosSincronizados = $produtos->filter(function ($produto) {
//                        return $produto->STATUS_SINC;
//                    })->toArray();
//
//                    $resultNotificacao = $this->enviarEmail($produtosSincronizados, $nPedido, $arrPedidoLog);
//
//                    if ($resultNotificacao) {
//                        $qtdProdutosSincronizados += count($produtosSincronizados);
//                        ++$qtdEmailsEnviados;
//
//                        //cria outra chave no array com os itens que foram atualizados no protheus
//                        $arrPedidoLog['update_protheus'] = json_encode($produtosSincronizados);
//                    } else {
//                        ++$qtdEmailsEnviados;
//                        $this->info('falha ao enviar o email -> update_protheus -> status E');
//                        $this->service->atualizarStatusProdutosProtheus($produtosSincronizados, 'E');
//                    }
//
//                }
//
//                //faz o push no array de log
//                array_push($logArr, $arrPedidoLog);
//                $this->info('Proximo...');
//            }
//        }
//
//        //monta o rodape do array do log
//        array_push($logArr, [
//            'end' => json_encode([
//                'qtd_prod_sincronizados' => $qtdProdutosSincronizados,
//                'qtd_emails_enviados' => $qtdEmailsEnviados
//            ])
//        ]);
//
//        //joga o array no arquivo de log
//        self::log(json_encode($logArr));
//        $this->info('end -> ' . microtime() . ' -> ' . $this->endTimer($starttime) . ' segs');
//    }
}
