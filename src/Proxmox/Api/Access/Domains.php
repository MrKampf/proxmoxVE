<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\Access\Domains\Realm;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Domains
 * @package proxmox\api\access
 */
class Domains extends PVEPathClassBase
{

    /**
     * Domains constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'domains/');
    }

    /**
     * Get specific API token information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @param string $realm
     * @return Realm
     */
    public function realm(string $realm): Realm
    {
        return new Realm($this->getPve(), $this->getPathAdditional() . $realm . '/');
    }

    /**
     * Authentication domain index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Add an authentication server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}