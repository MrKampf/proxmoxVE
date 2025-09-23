<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Storage;
use Proxmox\Helper\ApiPVE;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class StorageTest extends TestCase
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
            ->with('storage/')
            ->willReturn(['data' => 'ok']);

        $storage = new Storage($pve, '');
        $this->assertEquals(['data' => 'ok'], $storage->get());
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
            ->with('storage/')
            ->willReturn(['data' => 'ok']);

        $storage = new Storage($pve, '');
        $this->assertEquals(['data' => 'ok'], $storage->post());
    }

    public function testStorage()
    {
        $pve = $this->createMock(PVE::class);
        $storage = new Storage($pve, '');
        $this->assertInstanceOf(Storage\Storage::class, $storage->storage('test-storage'));
    }
}
