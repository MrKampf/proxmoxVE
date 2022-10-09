<?php

namespace Proxmox\Api\Access\Tfa;

use Proxmox\Api\Access\Tfa\UserId\Id;
use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class UserId
 * @package Proxmox\Api\Access\Tfa
 */
class UserId extends PVEPathClassBase implements PVEPathEndpointInterface
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
     * @param string $id
     * @return \Proxmox\Api\Access\Tfa\UserId\Id
     */
    public function id(string $id): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $id . '/');
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
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}