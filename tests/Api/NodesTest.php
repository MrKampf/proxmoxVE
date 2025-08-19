<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class NodesTest extends TestCase
{
    public function testGetNodes(): void
    {
        $this->mockResponse(200, [
            'data' => [
                [
                    'node' => 'node1',
                    'status' => 'online',
                ],
                [
                    'node' => 'node2',
                    'status' => 'offline',
                ],
            ]
        ]);

        $nodes = $this->api->nodes()->get();

        $this->assertCount(2, $nodes['data']);
        $this->assertEquals('node1', $nodes['data'][0]['node']);
        $this->assertEquals('online', $nodes['data'][0]['status']);
        $this->assertEquals('node2', $nodes['data'][1]['node']);
        $this->assertEquals('offline', $nodes['data'][1]['status']);
    }
}
