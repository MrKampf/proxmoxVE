<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Access;
use Proxmox\Api\Access\Acl;
use Proxmox\Api\Access\Domains;
use Proxmox\Api\Access\Groups;
use Proxmox\Api\Access\OpenId;
use Proxmox\Api\Access\Password;
use Proxmox\Api\Access\Permission;
use Proxmox\Api\Access\Roles;
use Proxmox\Api\Access\Tfa;
use Proxmox\Api\Access\Ticket;
use Proxmox\Api\Access\Users;
use Proxmox\Helper\ApiPVE;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class AccessTest extends TestCase
{
    public function testConstructor()
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
            ->with('access/')
            ->willReturn(['data' => 'ok']);

        $access = new Access($pve, '');
    }

    public function testDomains()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Domains::class, $access->domains());
    }

    public function testOpenId()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(OpenId::class, $access->openId());
    }

    public function testGroups()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Groups::class, $access->groups());
    }

    public function testRoles()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Roles::class, $access->roles());
    }

    public function testUsers()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Users::class, $access->users());
    }

    public function testAcl()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Acl::class, $access->acl());
    }

    public function testPassword()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Password::class, $access->password());
    }

    public function testPermission()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Permission::class, $access->permission());
    }

    public function testTfa()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Tfa::class, $access->tfa());
    }

    public function testTicket()
    {
        $pve = $this->createMock(PVE::class);
        $access = new Access($pve, '');
        $this->assertInstanceOf(Ticket::class, $access->ticket());
    }
}
