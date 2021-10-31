<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall\IpSet;

use Proxmox\Api\Cluster\Firewall\IpSet\Name\Cidr;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Name
 * @package Proxmox\Api\Cluster\Firewall\IpSet
 */
class Name extends PVEPathClassBase
{
    /**
     * Name constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read IP or Network settings from IPSet.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}/{cidr}
     * @param string $cidr
     * @return Cidr
     */
    public function cidr(string $cidr): Cidr
    {
        return new Cidr($this->getPve(), $this->getPathAdditional() . $cidr . '/');
    }

    /**
     * List IPSet content
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Add IP or Network to IPSet.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Delete IPSet
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}