<?php


namespace App\Modules\OlxAdvertisement\Repository\DB\MySql\Read;


use App\Models\OlxAdvertisement as OlxAdvertisementModel;
use App\Modules\OlxAdvertisement\OlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\DB\MySql\Traits\CreateOlxAdvertisement;
use App\Modules\OlxAdvertisement\Repository\Interfaces\ReadOlxAdvertisement;
use Illuminate\Database\Eloquent\Builder;

class OlxAdvertisementRepositoryRead implements ReadOlxAdvertisement
{
    use CreateOlxAdvertisement;
    /**
     * @return Builder
     */
    private function newQuery(): Builder {
        return OlxAdvertisementModel::query();
    }

    /**
     * @param string $slug
     * @return OlxAdvertisement|null
     */
    public function get(string $slug): OlxAdvertisement|null
    {
        $ads = $this->newQuery()->where("slug", $slug)->first();

        if(is_null($ads)) return null;

       return  $this->createOlxAdvertisement($ads);
    }
}
