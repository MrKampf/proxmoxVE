<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Storage;

use Proxmox\Api\Nodes\Node\Storage\Storage\Content;
use Proxmox\Api\Nodes\Node\Storage\Storage\DownloadUrl;
use Proxmox\Api\Nodes\Node\Storage\Storage\FileRestore;
use Proxmox\Api\Nodes\Node\Storage\Storage\Prunebackups;
use Proxmox\Api\Nodes\Node\Storage\Storage\Rrd;
use Proxmox\Api\Nodes\Node\Storage\Storage\Rrddata;
use Proxmox\Api\Nodes\Node\Storage\Storage\Status;
use Proxmox\Api\Nodes\Node\Storage\Storage\Upload;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Storage
 * @package Proxmox\Api\Nodes\Node\Storage
 */
class Storage extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * List storage content.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/content
     * @return Content
     */
    public function content(): Content
    {
        return new Content($this->getPve(), $this->getPathAdditional());
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/file-restore
     * @return FileRestore
     */
    public function fileRestore(): FileRestore
    {
        return new FileRestore($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Download templates and ISO images by using an URL.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/download-url
     * @return DownloadUrl
     */
    public function downloadUrl(): DownloadUrl
    {
        return new DownloadUrl($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get prune information for backups. NOTE: this is only a preview and might not be what a subsequent prune call does if backups are removed/added in the meantime.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/prunebackups
     * @return Prunebackups
     */
    public function prunebackups(): Prunebackups
    {
        return new Prunebackups($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read storage RRD statistics (returns PNG).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/rrd
     * @return Rrd
     */
    public function rrd(): Rrd
    {
        return new Rrd($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read storage RRD statistics.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/rrddata
     * @return Rrddata
     */
    public function rrddata(): Rrddata
    {
        return new Rrddata($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read storage status.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/status
     * @return Status
     */
    public function status(): Status
    {
        return new Status($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Upload templates and ISO images.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/upload
     * @return Upload
     */
    public function upload(): Upload
    {
        return new Upload($this->getPve(), $this->getPathAdditional());
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}