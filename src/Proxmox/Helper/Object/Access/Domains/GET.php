<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper\Object\Access\Domains;

/**
 * Class GET
 * @package Proxmox\Helper\Object\Access\Domain
 */
class GET
{
    /**
     * @var string
     */
    private string $realm;
    /**
     * @var string
     */
    private string $type;
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
    public function getRealm(): string
    {
        return $this->realm;
    }

    /**
     * @param string $realm
     */
    public function setRealm(string $realm): void
    {
        $this->realm = $realm;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

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

    /**
     * Fill the object with information from the pve api
     * @param array $array
     * @return bool
     */
    public function fillFromApi(array $array): bool
    {
        $this->setRealm($array['realm']);
        $this->setType($array['type']);
        if (key_exists('comment', $array)) {
            $this->setComment($array['comment']);
        }
        if (key_exists('tfa', $array)) {
            $this->setComment($array['tfa']);
        }
        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

}