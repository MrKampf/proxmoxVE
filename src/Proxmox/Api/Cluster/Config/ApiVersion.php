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
 * Class ApiVersion
 * @package Proxmox\Api\Cluster\Config
 */
class ApiVersion extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * ApiVersion constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'apiversion/');
    }

    /**
     * Return the version of the cluster join API available on this node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/config/apiversion
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

}