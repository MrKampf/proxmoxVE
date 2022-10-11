<?php

namespace Proxmox\Api\Access\Tfa\UserId;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Id
 * @package Proxmox\Api\Access\Tfa\UserId
 */
class Id extends PVEPathClassBase implements PVEPathEndpointInterface
{

    /**
     * @param \Proxmox\PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * @param array $params
     * @return array|null
     */
    public function delete(array $params = []): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional(), $params);
    }

}