<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall;

use Proxmox\Api\Cluster\Firewall\Groups\Group;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Groups
 * @package Proxmox\Api\Cluster\Firewall
 */
class Groups extends PVEPathClassBase
{

    /**
     * Groups constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'groups/');
    }

    /**
     * List rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups/{group}
     * @param string $group
     * @return Group
     */
    public function group(string $group): Group
    {
        return new Group($this->getPve(), $this->getPathAdditional() . $group . '/');
    }

    /**
     * List security groups.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create new security group.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}