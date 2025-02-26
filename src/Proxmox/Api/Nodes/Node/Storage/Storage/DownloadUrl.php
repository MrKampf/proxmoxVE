<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Storage\Storage;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class DownloadUrl
 * @package Proxmox\Api\Nodes\Node\Storage\Storage
 */
class DownloadUrl extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'download-url/');
    }

    /**
     * Download templates and ISO images by using an URL.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/download-url
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}