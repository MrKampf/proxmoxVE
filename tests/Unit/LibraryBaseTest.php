<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Proxmox\PVE;

class LibraryBaseTest extends TestCase
{

    private function getMockResponse(string $filepath, int $statusCode = 200): Response {
        $responseData = include __DIR__ . "/../mocks/{$filepath}.php";
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($responseData));
    }

    public function testLogin(): void {
        $mock = new MockHandler([
            $this->getMockResponse('access/ticket/m_post'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $proxmox = new PVE('host', 'user', 'pass', 8006, 'pam', false, false, $client);

        $this->assertNotEmpty($proxmox->getTicket());

        $cookieArray = $proxmox->getCookie()->toArray()[0];
        $this->assertArrayHasKey('Name', $cookieArray);
        $this->assertEquals('PVEAuthCookie', $cookieArray['Name']);

        //Check is value exists and
        $this->assertArrayHasKey('Value', $cookieArray);
        $this->assertNotEmpty($cookieArray['Value']);
        $this->assertIsString($cookieArray['Value']);
    }

    public function testFailedLogin(): void {
        $mock = new MockHandler([
            $this->getMockResponse('access/ticket/m_post_failed', 401),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $proxmox = new PVE('host', 'user', 'pass', 8006, 'pam', false, false, $client);

        $this->assertNull($proxmox->getTicket());
        $this->assertNull($proxmox->getCSRFPreventionToken());
    }

}