<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Storage\Storage;

use Proxmox\Api\Nodes\Node\Storage\Storage\Content\Volume;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Content
 * @package Proxmox\Api\Nodes\Node\Storage\Storage
 */
class Content extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'content/');
    }

    /**
     * Get volume attributes
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/content/{volume}
     * @param string $Volume
     * @return \Proxmox\Api\Nodes\Node\Storage\Storage\Content\Volume
     */
    public function volume(string $Volume): Volume
    {
        return new Volume($this->getPve(), $this->getPathAdditional() . $Volume . '/');
    }

    /**
     * List storage content.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/content
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Allocate disk images.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}/content
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}