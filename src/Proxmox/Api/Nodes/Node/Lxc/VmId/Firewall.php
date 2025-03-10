<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Lxc\VmId;

use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\Aliases;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\IpSet;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\Log;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\Options;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\Refs;
use Proxmox\Api\Nodes\Node\Lxc\VmId\Firewall\Rules;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Firewall
 * @package Proxmox\Api\Nodes\Node\Lxc\VmId
 */
class Firewall extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'firewall/');
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/aliases
     * @return Aliases
     */
    public function aliases(): Aliases
    {
        return new Aliases($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List IPSets
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/ipset
     * @return IpSet
     */
    public function ipSet(): IpSet
    {
        return new IpSet($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/rules
     * @return Rules
     */
    public function rules(): Rules
    {
        return new Rules($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read firewall log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/log
     * @return Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get VM firewall options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/options
     * @return Options
     */
    public function options(): Options
    {
        return new Options($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Read firewall log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall/log
     * @return Refs
     */
    public function refs(): Refs
    {
        return new Refs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/firewall
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}