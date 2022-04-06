<?php
namespace Core\Services;

use Aws\Lambda\Exception\LambdaException;
use Aws\Laravel\AwsFacade as AWS;
use Illuminate\Support\Facades\Config;

class LambdaService extends BaseService
{
    protected $client;

    public function __construct()
    {
        $config = Config::get('aws');
        //LOCAL
        //$this->clientDynamo = AWS::createClient('DynamoDb', ['region'=>'sa-east-1', 'endpoint'=> 'http://172.20.0.211:8000']);
        //Utiliza as credenciais
        $this->client = AWS::createClient('Lambda', ['region'=>'sa-east-1']);
    }

    public function getFunction($functionName)
    {
       try{
           $result = $this->client->getFunctionConfiguration([
               'FunctionName' => $functionName
           ]);

           return $result;
        } catch (LambdaException $e) {
            throw $e;
        }
    }

}
