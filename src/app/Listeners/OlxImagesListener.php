<?php

namespace App\Listeners;

use App\Events\SaveImagesEvent;
use App\Services\SaveImage\SaveImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class OlxImagesListener
{
    /**
     * @var SaveImage
     */
    private SaveImage $imageService;


    /**
     * OlxImagesListener constructor.
     * @param SaveImage $imageService
     */
    public function __construct(SaveImage $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param SaveImagesEvent $event
     */
    public function handle(SaveImagesEvent $event): void
    {
        $this->imageService->removeUserFolderImages();

        $event->images->each(function ($img) {
            $this->imageService->save($img->getLink());
        });
    }
}
