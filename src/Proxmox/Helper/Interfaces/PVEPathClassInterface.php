<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper\Interfaces;


use Proxmox\API;
use Proxmox\PVE;

interface PVEPathClassInterface
{

    /**
     * Domains constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional);

    /**
     * @return string
     */
    public function getPathAdditional(): string;

    /**
     * @param string $pathAdditional
     */
    public function setPathAdditional(string $pathAdditional): void;

    /**
     * @return PVE|API
     */
    public function getPve(): PVE|API;

    /**
     * @param PVE|API $pve
     */
    public function setPve(PVE|API $pve): void;

}