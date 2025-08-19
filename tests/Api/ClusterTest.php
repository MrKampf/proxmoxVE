<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class ClusterTest extends TestCase
{
    public function testGetCluster(): void
    {
        $this->mockResponse(200, [
            'data' => [
                'acme' => [],
                'backup' => [],
                'ha' => [],
            ]
        ]);

        $cluster = $this->api->cluster()->get();

        $this->assertIsArray($cluster['data']['acme']);
        $this->assertIsArray($cluster['data']['backup']);
        $this->assertIsArray($cluster['data']['ha']);
    }
}
