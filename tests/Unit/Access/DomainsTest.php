<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Proxmox\PVE;

class DomainsTest extends TestCase
{

    private function getMockResponse(string $filepath, int $statusCode = 200): Response
    {
        $responseData = include __DIR__ . "/../../mocks/{$filepath}.php";
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($responseData));
    }

    public function testDomainsGetEmpty(): void
    {
        $mock = new MockHandler([
            $this->getMockResponse('access/ticket/m_post'),
            $this->getMockResponse('access/domains/m_get'),
            $this->getMockResponse('access/domains/m_get'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $proxmox = new PVE('host', 'user', 'pass', 8006, 'pam', false, false, $client);

        $this->assertIsArray($proxmox->access()->domains()->get());

    }

}