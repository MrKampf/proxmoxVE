<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Users\UserId;

use Proxmox\Api\Access\Users\UserId\Token\TokenId;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class token
 * @package proxmox\api\access\users\userid
 */
class Token extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * Token constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'token/');
        return $this->get();
    }

    /**
     * Get user API tokens.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Get specific API token information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/token/{tokenid}
     * @param string $tokenId
     * @return TokenId
     */
    public function tokenId(string $tokenId): TokenId
    {
        return new TokenId($this->getPve(), $this->getPathAdditional() . $tokenId . '/');
    }

}