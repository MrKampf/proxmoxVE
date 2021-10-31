<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Ticket
 * @package Proxmox\Api\Access
 */
class Ticket extends PVEPathClassBase
{

    /**
     * Access constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'ticket/');
    }

    /**
     * Dummy. Useful for formatters which want to provide a login page.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
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