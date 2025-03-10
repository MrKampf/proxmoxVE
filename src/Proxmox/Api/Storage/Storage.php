<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Storage;


use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Storage
 * @package Proxmox\Api\Storage
 */
class Storage extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Storage constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }


}