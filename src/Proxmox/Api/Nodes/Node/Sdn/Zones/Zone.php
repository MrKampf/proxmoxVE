<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Sdn\Zones;

use Proxmox\Api\Nodes\Node\Sdn\Zones\Zone\Content;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Zone
 * @package Proxmox\Api\Nodes\Node\Sdn\Zones
 */
class Zone extends PVEPathClassBase
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
     * List zone content.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/sdn/zones/{zone}/content
     * @return Content
     */
    public function content(): Content
    {
        return new Content($this->getPve(), $this->getPathAdditional());
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/sdn/zones/{zone}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}