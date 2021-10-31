<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Tfa
 * @package Proxmox\Api\Access
 */
class Tfa extends PVEPathClassBase
{

    /**
     * Access constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tfa/');
    }

    /**
     * Change user u2f authentication.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Finish a u2f challenge.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}