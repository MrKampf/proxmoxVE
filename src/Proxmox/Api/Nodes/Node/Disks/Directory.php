<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Directory
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Directory extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'directory/');
    }

    /**
     * PVE Managed Directory storages.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/directory
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create a Filesystem on an unused disk. Will be mounted under '/mnt/pve/NAME'.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/directory
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}