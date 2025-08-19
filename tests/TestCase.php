<?php

namespace Proxmox\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Proxmox\API;

abstract class TestCase extends BaseTestCase
{
    protected API $api;
    protected MockHandler $mockHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        $this->api = new API('localhost', 'user', 'secret', 8006, false, $client);
    }

    protected function mockResponse(int $statusCode, array $body = [], array $headers = ['Content-Type' => 'application/json']): void
    {
        $this->mockHandler->append(new Response($statusCode, $headers, json_encode($body)));
    }
}
