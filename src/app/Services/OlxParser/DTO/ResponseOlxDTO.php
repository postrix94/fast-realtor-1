<?php


namespace App\Services\OlxParser\DTO;


class ResponseOlxDTO
{
    private const SUCCESS_HTTP_STATUS_CODE = 200;
    private int $statusCode;
    private ?string $response;


    /**
     * ResponseOlxDTO constructor.
     * @param int $statusCode
     * @param string|null $response
     */
    public function __construct(int $statusCode, string $response = null)
    {
        $this->statusCode = $statusCode;
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string|null
     */
    public function getResponse(): ?string
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return ((self::SUCCESS_HTTP_STATUS_CODE === $this->statusCode) && !is_null($this->response));
    }
}
