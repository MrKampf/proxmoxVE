<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Firewall\Aliases;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Name
 * @package Proxmox\Api\Cluster\Firewall\Aliases
 */
class Name extends PVEPathClassBase
{
    /**
     * Name constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read alias.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases/{name}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update IP or Network alias.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases/{name}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Remove IP or Network alias.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases/{name}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}