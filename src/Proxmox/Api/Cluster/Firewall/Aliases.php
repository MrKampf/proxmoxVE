<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall;

use Proxmox\Api\Cluster\Firewall\Aliases\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Aliases
 * @package Proxmox\Api\Cluster\Firewall
 */
class Aliases extends PVEPathClassBase
{

    /**
     * Aliases constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'aliases/');
    }

    /**
     * Read alias.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases/{name}
     * @param string $name
     * @return Name
     */
    public function name(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }

    /**
     * List aliases
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create IP or Network Alias.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}