<?php

namespace Authenticator\Tests\Controllers;

use Aws\Laravel\AwsFacade as AWS;
use Aws\Sdk;
use Tests\TestCase;


class S3ControllerTest extends TestCase {
    private $s3;
    private $uriTest = 'tests.myamazon.com';

    public function setClient(){
        $this->s3 = AWS::createClient('S3', [
            'region'          => 'us-standard',
            'version'         => 'latest',
            'endpoint'        => "http://{$this->uriTest}",
            'credentials' => ['key' => 'foo', 'secret' => 'bar'],
            'bucket_endpoint' => true
        ]);
    }

    public function testCanBeResolvedToCloudFrontInstance()
    {
        $this->setClient();
        $this->assertInstanceOf('Aws\S3\S3Client', $this->s3);
    }

//    public function testCanDoSomethingWithYourAppsFileBrowserClass()
//    {
//
//        // Mock the ListBuckets method of S3 client
//        $mockS3Client = $this->getMockBuilder('Aws\S3\S3Client')
//            ->disableOriginalConstructor()
//            ->getMock();
//        $mockS3Client->expects($this->any())
//            ->method('listBuckets')
//            ->will($this->returnValue(new Model(array(
//                'Buckets' => array(
//                    array('Name' => 'foo'),
//                    array('Name' => 'bar'),
//                    array('Name' => 'baz')
//                )
//            ))));
//        $this->serviceBuilder->set('s3', $mockS3Client);
//
//        // Test the FileBrowser object that uses the S3 client facade internally
//        $fileBrowser = new FileBrowser();
//        $partitions = $fileBrowser->getPartitions();
//        $this->assertEquals(array('foo', 'bar', 'baz'), $partitions);
//    }
}
