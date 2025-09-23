<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Nodes;
use Proxmox\Api\Nodes\Node;
use Proxmox\Helper\ApiPVE;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class NodesTest extends TestCase
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
            ->with('nodes/')
            ->willReturn(['data' => 'ok']);

        $nodes = new Nodes($pve, '');
        $this->assertEquals(['data' => 'ok'], $nodes->get());
    }

    public function testNode()
    {
        $pve = $this->createMock(PVE::class);
        $nodes = new Nodes($pve, '');
        $this->assertInstanceOf(Node::class, $nodes->node('test-node'));
    }
}
