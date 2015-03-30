<?php

use GuzzleHttp\Client;
use GuzzleHttp\Ring\Client\MockHandler;

class ApiTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test can s/get PID and Request options
     */
    public function testSetAndGet()
    {
        $params = [
            'pid' => 'EXAMPLE',
            'email' => 'test@example.com',
            'fname' => 'John',
            'lname' => 'Doe',
            'addr1' => 'Addr1',
            'addr2' => 'Addr2',
            'city' => 'City',
            'state' => 'OH',
            'zip' => '123456',
            'country' => 'USA',
            'phone' => '',
            'mobile' => '',
            'gender' => '',
            'dob' => '',
            'source' => '',
            'ip' => '',
            'date' => '',
            'jobtitle' => '',
            'industry' => '',
        ];

        $requestUrl = 'http://feeds.restorationmedia.net/partnersfeed.php'
            . '?pid=EXAMPLE'
            . '&email=test%40example.com'
            . '&fname=John'
            . '&lname=Doe'
            . '&addr1=Addr1'
            . '&addr2=Addr2'
            . '&city=City'
            . '&state=OH'
            . '&zip=123456'
            . '&country=USA'
            . '&gender='
            . '&dob='
            . '&source='
            . '&ip='
            . '&date='
            . '&jobtitle='
            . '&industry=';

        $client = new Client();
        $api = new \RestorationMedia\RestorationMediaApi($client, 'EXAMPLE', 'test@example.com', '255.255.255.255', 'www.example.com', '2015-03-30', $params);

        $this->assertEquals('EXAMPLE', $api->getPid());
        $this->assertEquals('test@example.com', $api->getEmail());
        $this->assertEquals($requestUrl, $api->getBuiltUrl());
        $this->assertEquals('John', $api->getFname());
        $this->assertEquals('Doe', $api->getLname());
        $this->assertEquals('Addr1', $api->getAddr1());
        $this->assertEquals('Addr2', $api->getAddr2());
        $this->assertEquals('', $api->getIndustry());
    }


    /**
     * Test successful request
     */
    public function testSuccessfulRequest()
    {
        $response = [
            'body' => '<?xml version="1.0" encoding="UTF-8"?><response>success.</response>',
            'status' => 200,
        ];
        $mock = new MockHandler($response);

        $client = new Client(['handler' => $mock]);

        $api = new \RestorationMedia\RestorationMediaApi($client, 'EXAMPLE', 'test@example.com', '255.255.255.255', 'www.example.com', '2015-03-30');

        $requestUrl = 'http://feeds.restorationmedia.net/partnersfeed.php'
            . '?pid=EXAMPLE'
            . '&email=test%40example.com'
            . '&fname='
            . '&lname='
            . '&addr1='
            . '&addr2='
            . '&city='
            . '&state='
            . '&zip='
            . '&country='
            . '&gender='
            . '&dob='
            . '&source=www.example.com'
            . '&ip=255.255.255.255'
            . '&date=2015-03-30'
            . '&jobtitle='
            . '&industry=';

        $this->assertEquals($requestUrl, $api->getBuiltUrl());
        $this->assertTrue($api->send());
        $this->assertEquals('success.', $api->getResponse()->xml());
    }


    /**
     * Test invalid request
     */
    public function testInvalidEmailRequest()
    {
        $response = [
            'body' => '<?xml version="1.0" encoding="UTF-8"?><response>Invalid Email.</response>',
            'status' => 200,
        ];
        $mock = new MockHandler($response);

        $client = new Client(['handler' => $mock]);

        $api = new \RestorationMedia\RestorationMediaApi($client, 'EXAMPLE', 'test@example.com', '255.255.255.255', 'www.example.com', '2015-03-30');

        $requestUrl = 'http://feeds.restorationmedia.net/partnersfeed.php'
            . '?pid=EXAMPLE'
            . '&email=test%40example.com'
            . '&fname='
            . '&lname='
            . '&addr1='
            . '&addr2='
            . '&city='
            . '&state='
            . '&zip='
            . '&country='
            . '&gender='
            . '&dob='
            . '&source=www.example.com'
            . '&ip=255.255.255.255'
            . '&date=2015-03-30'
            . '&jobtitle='
            . '&industry=';

        $this->assertEquals($requestUrl, $api->getBuiltUrl());
        $this->assertFalse($api->send());
        $this->assertEquals('Invalid Email.', $api->getResponse()->xml());
    }


    /**
     * Test missing PID throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage PID required parameter
     */
    public function testMissingPidThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), '', 'test@example.com', '255.255.255.255', 'www.example.com', '2015-03-30');
    }


    /**
     * Test missing Email throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Valid email required parameter
     */
    public function testMissingEmailThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), 'EXAMPLE', '', '255.255.255.255', 'www.example.com', '2015-03-30');
    }


    /**
     * Test invalid Email throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Valid email required parameter
     */
    public function testInvalidEmailThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), 'EXAMPLE', 'bobo', '255.255.255.255', 'www.example.com', '2015-03-30');
    }


    /**
     * Test missing IP throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage IP required parameter
     */
    public function testMissingIpThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), 'EXAMPLE', 'test@example.com', '', 'www.example.com', '2015-03-30');
    }


    /**
     * Test missing Source throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Source required parameter
     */
    public function testMissingSourceThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), 'EXAMPLE', 'test@example.com', '255.255.255.255', '', '2015-03-30');
    }


    /**
     * Test missing Date throws error
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Date required parameter
     */
    public function testMissingDateThrowsError()
    {
        new \RestorationMedia\RestorationMediaApi(new Client(), 'EXAMPLE', 'test@example.com', '255.255.255.255', 'www.example.com', '');
    }

}
