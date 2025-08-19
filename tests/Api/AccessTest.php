<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class AccessTest extends TestCase
{
    public function testGetAccess(): void
    {
        $this->mockResponse(200, [
            'data' => [
                'acls' => [],
                'roles' => [],
                'users' => [],
            ]
        ]);

        $access = $this->api->access()->get();

        $this->assertIsArray($access['data']['acls']);
        $this->assertIsArray($access['data']['roles']);
        $this->assertIsArray($access['data']['users']);
    }
}
