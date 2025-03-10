<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Domains\Realm;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Sync
 * @package Proxmox\Api\Access\Domains\Realm
 */
class Sync extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Domains constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     * @param array $params
     */
    public function __construct(PVE|API $pve, string $parentAdditional, array $params = [])
    {
        parent::__construct($pve, $parentAdditional . 'sync/');
        return $this->post($params);
    }

    /**
     * Syncs users and/or groups from the configured LDAP to user.cfg. NOTE: Synced groups will have the name 'name-$realm', so make sure those groups do not exist to prevent overwriting.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains/{realm}/sync
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}