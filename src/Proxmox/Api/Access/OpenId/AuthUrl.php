<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\OpenId;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class AuthUrl
 * @package Proxmox\Api\Access\OpenId
 */
class AuthUrl extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * AuthUrl constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     * @param array $params
     */
    public function __construct(PVE|API $pve, string $parentAdditional, array $params = [])
    {
        parent::__construct($pve, $parentAdditional . 'auth-url/');
        return $this->post($params);
    }

    /**
     * Get the OpenId Authorization Url for the specified realm.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/auth-url
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}