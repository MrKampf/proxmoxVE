<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall;

use Proxmox\Api\Cluster\Firewall\IpSet\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class IpSet
 * @package Proxmox\Api\Cluster\Firewall
 */
class IpSet extends PVEPathClassBase
{

    /**
     * IpSet constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ipset/');
    }

    /**
     * List IPSet content
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset/{name}
     * @param string $name
     * @return Name
     */
    public function cidr(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }

    /**
     * List IPSets
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create new IPSet
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}