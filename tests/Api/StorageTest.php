<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class StorageTest extends TestCase
{
    public function testGetStorage(): void
    {
        $this->mockResponse(200, [
            'data' => [
                [
                    'storage' => 'local',
                    'type' => 'dir',
                ],
                [
                    'storage' => 'local-lvm',
                    'type' => 'lvmthin',
                ],
            ]
        ]);

        $storage = $this->api->storage()->get();

        $this->assertCount(2, $storage['data']);
        $this->assertEquals('local', $storage['data'][0]['storage']);
        $this->assertEquals('dir', $storage['data'][0]['type']);
        $this->assertEquals('local-lvm', $storage['data'][1]['storage']);
        $this->assertEquals('lvmthin', $storage['data'][1]['type']);
    }
}
