<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class PVEPathClassBase
 * @package Proxmox\Helper\Interfaces
 */
class PVEPathClassBase implements PVEPathClassInterface
{

    /**
     * @var string
     */
    private string $pathAdditional;

    /**
     * @var PVE
     */
    private PVE $pve;

    /**
     * Access constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        $this->setPve($pve); //Save PVE in variable $this->pve
        $this->setPathAdditional($parentAdditional);
    }

    /**
     * @return string
     */
    public function getPathAdditional(): string
    {
        return $this->pathAdditional;
    }

    /**
     * @param string $pathAdditional
     */
    public function setPathAdditional(string $pathAdditional): void
    {
        $this->pathAdditional = $pathAdditional;
    }

    /**
     * @return PVE
     */
    public function getPve(): PVE
    {
        return $this->pve;
    }

    /**
     * @param PVE|API $pve
     */
    public function setPve(PVE $pve): void
    {
        $this->pve = $pve;
    }
}