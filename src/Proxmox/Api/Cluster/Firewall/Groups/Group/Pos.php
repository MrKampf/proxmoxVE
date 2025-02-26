<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall\Groups\Group;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Pos
 * @package Proxmox\Api\Cluster\Firewall\Groups\Group
 */
class Pos extends PVEPathClassBase
{
    /**
     * Pos constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get single rule data.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups/{group}/{pos}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Modify rule data.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups/{group}/{pos}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete rule.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups/{group}/{pos}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}