<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Exception;

use RuntimeException;
use Throwable;

/**
 * Thrown by the request helpers when a Proxmox API call fails and the
 * API/PVE client was constructed with throwOnError enabled.
 *
 * Carries the HTTP method + request path and, when the failure produced an
 * HTTP response, the status code and raw response body — so callers can
 * surface the real Proxmox error (e.g. "storage 'ISO' does not support
 * content type 'import'") instead of the library's historic silent null.
 *
 * @package Proxmox\Exception
 */
class ProxmoxApiException extends RuntimeException
{
    /**
     * @var string HTTP method (GET, POST, PUT, DELETE).
     */
    private string $method;

    /**
     * @var string Request path relative to the API base URL.
     */
    private string $path;

    /**
     * @var int|null HTTP status code, or null for transport-layer failures.
     */
    private ?int $statusCode;

    /**
     * @var string|null Raw response body, when an HTTP response was received.
     */
    private ?string $responseBody;

    public function __construct(
        string $message,
        string $method,
        string $path,
        ?int $statusCode = null,
        ?string $responseBody = null,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);

        $this->method = $method;
        $this->path = $path;
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int|null
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @return string|null
     */
    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }
}
