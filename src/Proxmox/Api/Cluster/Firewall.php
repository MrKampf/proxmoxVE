<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Firewall\Aliases;
use Proxmox\Api\Cluster\Firewall\Groups;
use Proxmox\Api\Cluster\Firewall\IpSet;
use Proxmox\Api\Cluster\Firewall\Macros;
use Proxmox\Api\Cluster\Firewall\Options;
use Proxmox\Api\Cluster\Firewall\Refs;
use Proxmox\Api\Cluster\Firewall\Rules;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Firewall
 * @package Proxmox\Api\Cluster
 */
class Firewall extends PVEPathClassBase
{
    /**
     * Firewall constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'firewall/');
    }

    /**
     * List aliases
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/aliases
     * @return Aliases
     */
    public function aliases(): Aliases
    {
        return new Aliases($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List security groups.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/groups
     * @return Groups
     */
    public function groups(): Groups
    {
        return new Groups($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List IPSets
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/ipset
     * @return IpSet
     */
    public function ipSet(): IpSet
    {
        return new IpSet($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/rules
     * @return Rules
     */
    public function rules(): Rules
    {
        return new Rules($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List available macros
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/macros
     * @return Macros
     */
    public function macros(): Macros
    {
        return new Macros($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Firewall options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/options
     * @return Options
     */
    public function options(): Options
    {
        return new Options($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Lists possible IPSet/Alias reference which are allowed in source/dest properties.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall/refs
     * @return Refs
     */
    public function refs(): Refs
    {
        return new Refs($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/firewall
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}