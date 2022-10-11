<?php

namespace Proxmox\Helper\Interfaces;

use Proxmox\PVE;

/**
 * Interface PVEPathEndpointInterface
 * @package proxmox\helper\interfaces
 */
interface PVEPathEndpointInterface
{

    public function __construct(PVE $pve, string $parentAdditional);

}