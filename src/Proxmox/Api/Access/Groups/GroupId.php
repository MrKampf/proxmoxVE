<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Groups;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class GroupId
 * @package Proxmox\Api\Access\Groups
 */
class GroupId extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * GroupId constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get group configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update group data.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete group.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}