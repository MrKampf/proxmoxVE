<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Domains;

use Proxmox\Api\Access\Domains\Realm\Sync;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Realm
 * @package Proxmox\Api\Access\Domains
 */
class Realm extends PVEPathClassBase
{
    /**
     * Domains constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Syncs users and/or groups from the configured LDAP to user.cfg. NOTE: Synced groups will have the name 'name-$realm', so make sure those groups do not exist to prevent overwriting.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}/sync
     * @param array $params
     * @return Sync
     */
    public function sync(array $params = []): Sync
    {
        return new Sync($this->getPve(), $this->getPathAdditional(), $params);
    }

    /**
     * Get auth server configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @return mixed|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update authentication server settings.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @param $params array
     * @return mixed|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete an authentication server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}
     * @return mixed|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}