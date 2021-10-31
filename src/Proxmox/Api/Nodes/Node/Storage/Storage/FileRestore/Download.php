<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Storage\Storage\FileRestore;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Download
 * @package Proxmox\Api\Nodes\Node\Storage\Storage\Content
 */
class Download extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'download/');
    }

    /**
     * Extract a file or directory (as zip archive) from a PBS backup.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/file-restore/download
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}