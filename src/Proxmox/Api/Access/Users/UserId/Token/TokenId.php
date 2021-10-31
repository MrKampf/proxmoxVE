<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Users\UserId\Token;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class TokenId
 * @package Proxmox\Api\Access\Users\UserId\Token
 */
class TokenId extends PVEPathClassBase
{

    /**
     * TokenId constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get specific API token information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update API token for a specific user.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Generate a new API token for a specific user. NOTE: returns API token value, which needs to be stored as it cannot be retrieved afterwards!
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Remove API token for a specific user.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}