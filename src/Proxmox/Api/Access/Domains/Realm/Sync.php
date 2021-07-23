<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Domains\Realm;

use Proxmox\Helper\Interfaces\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Sync
 * @package Proxmox\Api\Access\Domains\Realm
 */
class Sync extends PVEPathClassBase
{
    /**
     * Domains constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional.'sync/');
    }

    /**
     * Syncs users and/or groups from the configured LDAP to user.cfg. NOTE: Synced groups will have the name 'name-$realm', so make sure those groups do not exist to prevent overwriting.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}/sync
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}