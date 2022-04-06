<?php

namespace Core\Middleware;

use Closure;
use Core\Models\DbFramework\Dbo\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use League\OAuth2\Server\ResourceServer;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

class VerificarJwtTokenPortal
{
    private $rotas = array(

    );

    /**
     * Create a new middleware instance.
     *
     * @param  \League\OAuth2\Server\ResourceServer $server
     * @return void
     */
    public function __construct() {
//        $this->publicKey = new Key('file://'.storage_path('app/public.key'));
        $this->parser = new Parser();
        $this->signer = new Sha256();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rota = $request->getRequestUri();
        if (in_array($rota, $this->rotas) || strpos($rota, 'livre') !== false) {
            return $next($request);
        } elseif ($request->hasHeader('Authorization')) {
                $authorization = $request->header('Authorization');
                $token = $this->parser->parse((string) $authorization);

                /* não consegui validar a assinatura */
//                $headers = $this->base64UrlEncode(json_encode($token->getHeaders()));
//                $body = $this->base64UrlEncode(json_encode($token->getClaims(), JSON_UNESCAPED_SLASHES));
//                $signature = hash_hmac('sha256', $headers . "." . $body, 'dps01-2015', true);

                $data = new ValidationData();
                $data->setCurrentTime(time());
                if ($token->validate($data) === false) {
                    //return response()->json(['error' => 1, 'mensagem' => 'Acesso do usuário expirado!'], 401);
                }

                $idUserPortal = $token->getClaim('sub');
                $authUserToken = User::find($idUserPortal);

                if (!$authUserToken || ($authUserToken && (int) $authUserToken->inStatus !== 1)) {
                    return response()->json(['error' => 1, 'mensagem' => 'Usuário não encontrado!'], 401);
                }

                auth()->login($authUserToken);

                return $next($request);
            } else {
                return response()->json(['error' => 1, 'mensagem' => 'Acesso Negado!'], 401);
            }
    }

    function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }
}
