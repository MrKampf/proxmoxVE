<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Firewall\Log;
use Proxmox\Api\Nodes\Node\Firewall\Options;
use Proxmox\Api\Nodes\Node\Firewall\Rules;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Firewall
 * @package Proxmox\Api\Nodes\Node
 */
class Firewall extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'firewall/');
    }

    /**
     * Read firewall log
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/firewall/log
     * @return Log
     */
    public function log(): Log
    {
        return new Log($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get host firewall options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/firewall/options
     * @return Options
     */
    public function options(): Options
    {
        return new Options($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List rules.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/firewall/rules
     * @return Rules
     */
    public function rules(): Rules
    {
        return new Rules($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/firewall
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}