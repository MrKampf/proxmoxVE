<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Version;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class VersionTest extends TestCase
{
    public function testGetVersion()
    {
        $pve = $this->getMockBuilder(PVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $api = $this->getMockBuilder(\Proxmox\Helper\ApiPVE::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pve->expects($this->once())
            ->method('getApi')
            ->willReturn($api);

        $api->expects($this->once())
            ->method('get')
            ->with('version/')
            ->willReturn(['data' => 'ok']);

        $version = new Version($pve, '');
        $this->assertEquals(['data' => 'ok'], $version->get());
    }
}
