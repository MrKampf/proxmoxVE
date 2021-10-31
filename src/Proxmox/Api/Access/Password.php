<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Password
 * @package Proxmox\Api\Access
 */
class Password extends PVEPathClassBase
{

    /**
     * Access constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'password/');
    }

    /**
     * Change user password.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/password
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }
}