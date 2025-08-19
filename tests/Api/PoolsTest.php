<?php

namespace Proxmox\Tests\Api;

use Proxmox\Tests\TestCase;

class PoolsTest extends TestCase
{
    public function testGetPools(): void
    {
        $this->mockResponse(200, [
            'data' => [
                [
                    'poolid' => 'pool1',
                    'comment' => 'This is a comment',
                ],
                [
                    'poolid' => 'pool2',
                    'comment' => '',
                ],
            ]
        ]);

        $pools = $this->api->pools()->get();

        $this->assertCount(2, $pools['data']);
        $this->assertEquals('pool1', $pools['data'][0]['poolid']);
        $this->assertEquals('This is a comment', $pools['data'][0]['comment']);
        $this->assertEquals('pool2', $pools['data'][1]['poolid']);
        $this->assertEquals('', $pools['data'][1]['comment']);
    }
}
