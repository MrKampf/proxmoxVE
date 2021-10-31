<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\access\users\UserId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class users
 * @package proxmox\api\access
 */
class Users extends PVEPathClassBase
{

    /**
     * Users constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'users/');
    }

    /**
     * Get user configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}
     * @param string $userID
     * @return UserId
     */
    public function userId(string $userID): UserId
    {
        return new UserId($this->getPve(), $this->getPathAdditional() . $userID . '/');
    }

    /**
     * Authentication domain index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Add an authentication server.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}