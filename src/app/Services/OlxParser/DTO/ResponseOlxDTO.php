<?php


namespace App\Services\OlxParser\DTO;


class ResponseOlxDTO
{
    private const SUCCESS_HTTP_STATUS_CODE = 200;
    private int $statusCode;
    private ?string $html;


    /**
     * ResponseOlxDTO constructor.
     * @param int $statusCode
     * @param string|null $html
     */
    public function __construct(int $statusCode, string $html = null)
    {
        $this->statusCode = $statusCode;
        $this->html = $html;
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
    public function getHtml(): ?string
    {
        return $this->html;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return ((self::SUCCESS_HTTP_STATUS_CODE === $this->statusCode) && !is_null($this->html));
    }


}
