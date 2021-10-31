<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Roles;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class RoleId
 * @package Proxmox\Api\Access\Roles
 */
class RoleId extends PVEPathClassBase
{

    /**
     * RoleId constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get role configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update an existing role.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles/{roleid}
     * @param $params array
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