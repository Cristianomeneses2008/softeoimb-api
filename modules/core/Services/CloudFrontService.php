<?php
namespace Core\Services;

use Aws\CloudFront\Exception\CloudFrontException;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\Laravel\AwsFacade as AWS;
use Illuminate\Support\Facades\Config;

class CloudFrontService extends BaseService
{
    protected $clientCloudFront;

    public function __construct($region = 'sa-east-1')
    {
        $config = Config::get('aws');
        $this->clientCloudFront = AWS::createClient('CloudFront', ['region'=> $region]);
    }

    public function invalidateObject($id, $path)
    {
        try {
            $result = $this->clientCloudFront->createInvalidation([
                'DistributionId' => $id,
                'InvalidationBatch' => [
                    'CallerReference' => uniqid(),
                    'Paths' => [
                        'Items' => $path,
                        'Quantity' => 1,
                    ],
                ]
            ]);
            return $result;
        } catch (CloudFrontException $e) {
            throw $e;
        }
    }
}
