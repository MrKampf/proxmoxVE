<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox;

/**
 * Class pve
 * @package proxmox
 */
class pve
{
    private $httpClient; //The http client for the connection to the host

    private
        $username, //Username
        $password, //The password for user
        $hostname, //Host, ip or domain
        $port, //Proxmox api port
        $authType, //User type (pve or pam)
        $debug, //Want debug connection
        $CSRFPreventionToken, //CSRF token for auth
        $ticket, //Auth ticket
        $apiURL; //API url

    /**
     * pve constructor.
     *
     * @param $hostnameOrArray
     * @param string|false $usernameOrDebug
     * @param string $password
     * @param int $port
     * @param string $authType
     * @param bool $debug
     */
    public function __construct($hostnameOrArray, $usernameOrDebug = false, string $password = "", int $port = 8006, string $authType = "pve", bool $debug = false)
    {
        if (is_array($hostnameOrArray)) {
            $this->hostname = $hostnameOrArray['hostname']; //Save hostname in class variable
            $this->username = $hostnameOrArray['username']; //Save username in class variable
            $this->password = $hostnameOrArray['password']; //Save user password in class variable
            $this->port = $hostnameOrArray['port']; //Save port in class variable
            $this->authType = $hostnameOrArray['authType']; //Save auth type in class variable
            $this->debug = $usernameOrDebug; //Save the debug boolean variable
            $this->apiURL = 'https://' . $this->hostname . ':' . $this->port; //Create the basic api url
        }
    }

}