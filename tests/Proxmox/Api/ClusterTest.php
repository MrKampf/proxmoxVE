<?php

namespace Proxmox\Tests\Api;

use Proxmox\Api\Cluster;
use Proxmox\Api\Cluster\Acme;
use Proxmox\Api\Cluster\Backup;
use Proxmox\Api\Cluster\BackupInfo;
use Proxmox\Api\Cluster\Ceph;
use Proxmox\Api\Cluster\Config;
use Proxmox\Api\Cluster\Firewall;
use Proxmox\Api\Cluster\Ha;
use Proxmox\Api\Cluster\Log;
use Proxmox\Api\Cluster\Metrics;
use Proxmox\Api\Cluster\NextId;
use Proxmox\Api\Cluster\Options;
use Proxmox\Api\Cluster\Replication;
use Proxmox\Api\Cluster\Resources;
use Proxmox\Api\Cluster\Sdn;
use Proxmox\Api\Cluster\Status;
use Proxmox\Api\Cluster\Tasks;
use Proxmox\Helper\ApiPVE;
use Proxmox\PVE;
use Proxmox\Tests\TestCase;

class ClusterTest extends TestCase
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
            ->with('cluster/')
            ->willReturn(['data' => 'ok']);

        $cluster = new Cluster($pve, '');
        $this->assertEquals(['data' => 'ok'], $cluster->get());
    }

    public function testAcme()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Acme::class, $cluster->acme());
    }

    public function testBackup()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Backup::class, $cluster->backup());
    }

    public function testBackupInfo()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(BackupInfo::class, $cluster->backupInfo());
    }

    public function testCeph()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Ceph::class, $cluster->ceph());
    }

    public function testConfig()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Config::class, $cluster->config());
    }

    public function testFirewall()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Firewall::class, $cluster->firewall());
    }

    public function testHa()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Ha::class, $cluster->ha());
    }

    public function testMetrics()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Metrics::class, $cluster->metrics());
    }

    public function testReplication()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Replication::class, $cluster->replication());
    }

    public function testSdn()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Sdn::class, $cluster->sdn());
    }

    public function testLog()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Log::class, $cluster->log());
    }

    public function testNextId()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(NextId::class, $cluster->nextId());
    }

    public function testOptions()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Options::class, $cluster->options());
    }

    public function testResources()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Resources::class, $cluster->resources());
    }

    public function testStatus()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Status::class, $cluster->status());
    }

    public function testTasks()
    {
        $pve = $this->createMock(PVE::class);
        $cluster = new Cluster($pve, '');
        $this->assertInstanceOf(Tasks::class, $cluster->tasks());
    }
}
