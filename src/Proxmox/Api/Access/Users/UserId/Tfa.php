<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access\Users\UserId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Tfa
 * @package Proxmox\Api\Access\Users\UserId
 */
class Tfa extends PVEPathClassBase
{

    /**
     * Tfa constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'tfa');
    }

    /**
     * Get user TFA types (Personal and Realm).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/Users/{userid}/tfa
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}