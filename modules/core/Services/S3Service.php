<?php
namespace Core\Services;

use Aws\Laravel\AwsFacade as AWS;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Config;

class S3Service extends BaseService
{
    protected $client;

    public function __construct()
    {
        $config = Config::get('aws');
        //LOCAL
        //$this->clientDynamo = AWS::createClient('DynamoDb', ['region'=>'sa-east-1', 'endpoint'=> 'http://172.20.0.211:8000']);
        //Utiliza as credenciais
        $this->client = AWS::createClient('S3', ['region'=>'sa-east-1']);
    }

    /**
     * @param $idUser
     * @param bool $onlyEdebeOn retorna apenas skus do tipo edebeOn
     * @return array
     */
    public function getByKey($key, $bucket)
    {
       try{
           $result = $this->client->getObject([
               'Bucket' => $bucket,
               'Key'    => $key
           ]);

            return $result['Body'];
        } catch (S3Exception $e) {
            throw $e;
        }
    }

    public function copyFromBucketToAnother($keyOrigin, $bucketOrigin, $keyTarget, $bucketTarget)
    {
        try{
            $result = $this->client->copyObject([
                'Bucket'     => $bucketTarget,
                'Key'        => "{$keyTarget}",
                'CopySource' => "{$bucketOrigin}/{$keyOrigin}",
            ]);

            return $result;
        } catch (S3Exception $e) {
            throw $e;
        }
    }

}
