<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall\IpSet\Name;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Cidr
 * @package Proxmox\Api\Cluster\Firewall\IpSet\Name
 */
class Cidr extends PVEPathClassBase
{
    /**
     * Cidr constructor.
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
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update IP or Network settings
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}/{cidr}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Remove IP or Network from IPSet.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}/{cidr}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}