<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Config;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class QDevice
 * @package Proxmox\Api\Cluster\Config
 */
class QDevice extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * QDevice constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'qdevice/');
    }

    /**
     * Get QDevice status
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/qdevice
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}