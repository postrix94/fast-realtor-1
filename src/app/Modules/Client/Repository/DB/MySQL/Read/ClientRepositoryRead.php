<?php

namespace App\Modules\Client\Repository\DB\MySQL\Read;

use App\Models\User;
use App\Modules\Client\Client;
use App\Modules\Client\DTO\AdsPaginationDTO;
use App\Modules\Client\DTO\AdsSearchDTO;
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
     * @param AdsSearchDTO $search
     * @return ResponseAdsDTO
     */
    public function ads(AdsPaginationDTO $paginationDTO, AdsSearchDTO $search): ResponseAdsDTO
    {
        $query = Auth::user()->adds()
            ->orderBy("created_at", $paginationDTO->dateOrderBy)
            ->without("images");

        if ($search->issetSearch()) {
            if ($search->title && $search->body) {
                $query->where(function($query) use($search){
                    $query->where("title", "like",  "%{$search->title}%")->orWhere("body", "like", "%{$search->body}%");
                });
            }
        } else {
            $query->limit($paginationDTO->limit)->offset($paginationDTO->offset);
        }


        $adsCollection = $this->createOlxAds($query->get());

        $total = $search->issetSearch()
            ? $query->count(["id"])
            : Auth::user()->adds()->without("images")->get(['id'])->count();

        return new ResponseAdsDTO($adsCollection, $total);
    }


}
