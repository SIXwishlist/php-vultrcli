<?php

class VutrlCommandTest extends \PHPUnit\Framework\TestCase
{

    public function test_account_info_command()
    {
        $accountInfo = (new \Vultr\Account())->setApiKey('TBHOK5BG6OHUVBQ662ZL6AE5ZLSSE6AWLXHQ')->account();

        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class,$accountInfo);
        $this->assertEquals(200,$accountInfo->getStatusCode());

        //just check any key that belongs to response
        $this->assertArrayHasKey('balance',(array) json_decode($accountInfo->getBody()->getContents()));
    }

    public function test_account_user_info_with_api_key_auth()
    {
        $userInfo = (New \Vultr\Account())->setApiKey('TBHOK5BG6OHUVBQ662ZL6AE5ZLSSE6AWLXHQ')->userInfo();

        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class,$userInfo);
        $this->assertEquals(200,$userInfo->getStatusCode());

        $response = (array) json_decode($userInfo->getBody()->getContents());

        $this->assertArrayHasKey('email',$response);
        $this->assertArrayHasKey('name',$response);
    }
}