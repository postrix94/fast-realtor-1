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
     * @param string $dateOrderBy
     */
    public function __construct(int $limit, int $offset, string $dateOrderBy = "DESC")
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->dateOrderBy = $dateOrderBy;
    }


}
