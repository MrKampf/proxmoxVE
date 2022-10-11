<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\Access\Tfa\UserId;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Tfa
 * @package Proxmox\Api\Access
 */
class Tfa extends PVEPathClassBase implements PVEPathEndpointInterface
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
     * @param string $userId
     * @return \Proxmox\Api\Access\Tfa\UserId
     */
    public function userId(string $userId): UserId
    {
        return new UserId($this->getPve(), $this->getPathAdditional() . $userId . '/');
    }

    /**
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
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