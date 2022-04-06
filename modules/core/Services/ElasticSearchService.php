<?php
namespace Core\Services;

use Aws\ElasticsearchService\ElasticsearchServiceClient;
use Aws\Laravel\AwsFacade as AWS;
use Illuminate\Support\Facades\Config;

class ElasticSearchService extends BaseService
{
    protected $client;

    public function __construct()
    {
        $config = Config::get('aws_logs');
        //LOCAL
        //$this->clientDynamo = AWS::createClient('DynamoDb', ['region'=>'sa-east-1', 'endpoint'=> 'http://172.20.0.211:8000']);
        //Utiliza as credenciais
        $this->client = AWS::createClient('es', ['region'=>'sa-east-1']);
    }

    public function postLog($data)
    {
        $domains = $this->client->listDomainNames();
        dd($domains);
    }
}
