<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\Access\Users\UserId;
use Proxmox\Api\Access\Users\UserId\Tfa;
use Proxmox\Api\Access\Users\UserId\Token;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Users
 * @package proxmox\api\access\users
 */
class Users extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * UserId constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * @param $userId
     * @return \Proxmox\Api\Access\Users\UserId
     */
    public function userId($userId): UserId
    {
        return new UserId($this->getPve(), $this->getPathAdditional() . $userId . '/');
    }

    /**
     * Get user configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}
