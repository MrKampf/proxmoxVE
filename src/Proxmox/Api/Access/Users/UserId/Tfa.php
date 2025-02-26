<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Users\UserId;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Tfa
 * @package Proxmox\Api\Access\Users\UserId
 */
class Tfa extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * Tfa constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tfa');
    }

    /**
     * Get user TFA types (Personal and Realm).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/tfa
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}