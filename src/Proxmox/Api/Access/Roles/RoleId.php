<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Roles;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class RoleId
 * @package Proxmox\Api\Access\Roles
 */
class RoleId extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * RoleId constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get role configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update an existing role.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete role.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}