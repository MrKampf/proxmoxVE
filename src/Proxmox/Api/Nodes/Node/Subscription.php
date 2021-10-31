<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Subscription
 * @package Proxmox\Api\Nodes\Node
 */
class Subscription extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'subscription/');
    }

    /**
     * Read subscription info
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/subscription
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update subscription info.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/subscription
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Set subscription key.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/subscription
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete subscription key of this node.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/subscription
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}