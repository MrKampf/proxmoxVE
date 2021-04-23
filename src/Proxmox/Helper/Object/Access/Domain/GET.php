<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper\Object\Access\Domain;

/**
 * Class GET
 * @package Proxmox\Helper\Object\Access\Domain
 */
class GET
{
    /**
     * @var string
     */
    private string $comment;

    /**
     * @var string
     */
    private string $tfa;

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getTfa(): string
    {
        return $this->tfa;
    }

    /**
     * @param string $tfa
     */
    public function setTfa(string $tfa): void
    {
        $this->tfa = $tfa;
    }

}