<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Storage;


use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Storage
 * @package Proxmox\Api\Storage
 */
class Storage extends PVEPathClassBase
{
    /**
     * Storage constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param $params array
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