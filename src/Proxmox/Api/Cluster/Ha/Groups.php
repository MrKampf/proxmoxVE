<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Ha;

use Proxmox\Api\Cluster\Ha\Groups\Group;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Groups
 * @package Proxmox\Api\Cluster\Ha
 */
class Groups extends PVEPathClassBase
{
    /**
     * Groups constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'groups/');
    }

    /**
     * Read ha group configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/groups/{group}
     * @param string $group
     * @return Group
     */
    public function group(string $group): Group
    {
        return new Group($this->getPve(), $this->getPathAdditional() . $group . '/');
    }

    /**
     * Get HA groups.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/groups
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new HA group.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/ha/groups
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}