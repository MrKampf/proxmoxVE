<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;


use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Storage
 * @package Proxmox\Api
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
        parent::__construct($pve, $parentAdditional . 'storage/');
    }

    /**
     * Read storage configuration.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage/{storage}
     * @param String $storage
     * @return Storage\Storage
     */
    public function storage(string $storage): Storage\Storage
    {
        return new Storage\Storage($this->getPve(), $this->getPathAdditional() . $storage . '/');
    }

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a new storage.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}