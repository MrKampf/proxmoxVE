<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Ticket
 * @package Proxmox\Api\Access
 */
class Ticket extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * Access constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ticket/');
    }

    /**
     * Dummy. Useful for formatters which want to provide a login page.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create or verify authentication ticket.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}