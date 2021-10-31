<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Users;

use Proxmox\Api\Access\Users\UserId\Tfa;
use Proxmox\Api\access\users\UserId\Token;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class UserId
 * @package proxmox\api\access\users
 */
class UserId extends PVEPathClassBase
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
     * Get user API tokens.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token
     * @return Token
     */
    public function token(): Token
    {
        return new Token($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get user TFA types (Personal and Realm).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/tfa
     * @return Tfa
     */
    public function tfa(): Tfa
    {
        return new Tfa($this->getPve(), $this->getPathAdditional());
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
     * Update user configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete user.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}