<?php

namespace App\Modules\Client\Repository\DB\MySQL\Read;

use App\Models\User;
use App\Modules\Client\Client;
use App\Modules\Client\DTO\AdsPaginationDTO;
use App\Modules\Client\DTO\Response\ResponseAdsDTO;
use App\Modules\Client\Repository\DB\MySQL\Traits\CreateClient;
use App\Modules\Client\Repository\DB\MySQL\Traits\CreateOlxAds;
use App\Modules\Client\Repository\Interfaces\ReadClient;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class ClientRepositoryRead implements ReadClient
{
    use CreateClient;
    use CreateOlxAds;

    private function newQuery(): Builder
    {
        return User::query();
    }

    public function auth(): Client|null
    {
        return Auth::check() ? $this->createClient(Auth::user()) : null;
    }

    /**
     * @param AdsPaginationDTO $paginationDTO
     * @return ResponseAdsDTO
     */
    public function ads(AdsPaginationDTO $paginationDTO): ResponseAdsDTO
    {
        $query = Auth::user()->adds()
            ->limit($paginationDTO->limit)->offset($paginationDTO->offset)
            ->orderBy("created_at", $paginationDTO->dateOrderBy)
            ->without("images");


        $adsCollection = $this->createOlxAds($query->get());
        $total = Auth::user()->adds()->without("images")->get(['id'])->count();

        return new ResponseAdsDTO($adsCollection, $total);
    }


}
