<?php

namespace Authenticator\Tests\Controllers;

use Aws\Laravel\AwsFacade as AWS;
use Tests\TestCase;

class CloudFrontControllerTest extends TestCase {
    private $serviceBuilder;

    public function testCanBeResolvedToCloudFrontInstance()
    {
        // Get an instance of a client (S3) via the facade.
        $cloudFront = AWS::createClient('CloudFront');
        $this->assertInstanceOf('Aws\CloudFront\CloudFrontClient', $cloudFront);
    }

//    public function testMockCanReturnResult()
//    {
//        \Mockery::
//        $model = new Model([
//            'Contents' => [
//                ['Key' => 'Obj1'],
//                ['Key' => 'Obj2'],
//                ['Key' => 'Obj3'],
//            ],
//        ]);

//        $client = $this->getMockBuilder('Aws\CloudFront\CloudFrontClient')
//            ->disableOriginalConstructor()
//            ->addMethods(['createInvalidation'])
//            ->getMock();
//
//        $client->expects($this->once())
//            ->method('createInvalidation')
//            ->with([
//                'DistributionId' => 234,
//                'InvalidationBatch' => [
//                    'CallerReference' => uniqid(),
//                    'Paths' => [
//                        'Items' => '/index.html',
//                        'Quantity' => 1,
//                    ],
//                ]
//            ])
//            ->will($this->returnValue([]));
//
//        $result = $client->createInvalidation(['Bucket' => 'foobar']);
    //}
}
