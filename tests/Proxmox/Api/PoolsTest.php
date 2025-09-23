<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Pools;
use Proxmox\Api\Pools\PoolId;
use Proxmox\Helper\ApiPVE;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class PoolsTest extends TestCase
{
    public function testGet()
    {
        $pve = $this->getMockBuilder(PVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $api = $this->getMockBuilder(ApiPVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pve->expects($this->once())
            ->method('getApi')
            ->willReturn($api);

        $api->expects($this->once())
            ->method('get')
            ->with('pools/')
            ->willReturn(['data' => 'ok']);

        $pools = new Pools($pve, '');
        $this->assertEquals(['data' => 'ok'], $pools->get());
    }

    public function testPost()
    {
        $pve = $this->getMockBuilder(PVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $api = $this->getMockBuilder(ApiPVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pve->expects($this->once())
            ->method('getApi')
            ->willReturn($api);

        $api->expects($this->once())
            ->method('post')
            ->with('pools/')
            ->willReturn(['data' => 'ok']);

        $pools = new Pools($pve, '');
        $this->assertEquals(['data' => 'ok'], $pools->post());
    }

    public function testPoolId()
    {
        $pve = $this->createMock(PVE::class);
        $pools = new Pools($pve, '');
        $this->assertInstanceOf(PoolId::class, $pools->poolId('test-pool'));
    }
}
