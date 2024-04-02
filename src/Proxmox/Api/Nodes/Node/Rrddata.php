<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Rrddata
 * @package Proxmox\Api\Nodes\Node
 */
class Rrddata extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'rrddata/');
    }

    /**
     * Read node RRD statistics
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/rrddata
     * @param array $params An array specifying the time intervals for which statistics should be retrieved.
     * Supported keys:
     * ['timeframe' =>
     * - 'hour': Retrieve statistics for the last hour.
     * - 'day': Retrieve statistics for the last day.
     * - 'week': Retrieve statistics for the last week.
     * - 'month': Retrieve statistics for the last month.
     * - 'year': Retrieve statistics for the last year.
     * ]
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}
