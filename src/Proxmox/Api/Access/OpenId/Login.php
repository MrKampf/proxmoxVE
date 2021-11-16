<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\OpenId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Login
 * @package Proxmox\Api\Access\OpenId
 */
class Login extends PVEPathClassBase
{

    /**
     * AuthUrl constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     * @param array $params
     */
    public function __construct(PVE $pve, string $parentAdditional, array $params = [])
    {
        parent::__construct($pve, $parentAdditional . 'login/');
        return $this->post($params);
    }

    /**
     * Verify OpenID authorization code and create a ticket.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/login
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}