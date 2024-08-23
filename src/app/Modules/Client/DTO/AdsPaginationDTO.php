<?php


namespace App\Modules\Client\DTO;


class AdsPaginationDTO
{
    public int $limit;
    public int $offset;
    public string $dateOrderBy;

    /**
     * AdsPaginationDTO constructor.
     * @param int $limit
     * @param int $offset
     * @param bool $dateOrderBy
     */
    public function __construct(int $limit, int $offset, bool $dateOrderBy)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->dateOrderBy = $dateOrderBy ? "ASC" : "DESC";
    }
}
