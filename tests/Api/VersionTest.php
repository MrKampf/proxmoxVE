<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class VersionTest extends TestCase
{
    public function testGetVersion(): void
    {
        $this->mockResponse(200, [
            'data' => [
                'version' => '7.0-10',
                'repoid' => '7.0-1',
                'release' => '7.0',
            ]
        ]);

        $version = $this->api->version()->get();

        $this->assertEquals('7.0-10', $version['data']['version']);
        $this->assertEquals('7.0-1', $version['data']['repoid']);
        $this->assertEquals('7.0', $version['data']['release']);
    }
}
