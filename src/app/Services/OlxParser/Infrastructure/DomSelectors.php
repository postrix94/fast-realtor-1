<?php


namespace App\Services\OlxParser\Infrastructure;


final class DomSelectors
{
    /**
     * @var string
     */
    public string $cssClassHeader = "h4.css-1kc83jo";
    /**
     * @var string
     */
    public string $cssClassPrice = "h3.css-90xrc0";

    /**
     * @var string
     */
    public string $cssClassBody = "div[data-cy='ad_description'] > div.css-1o924a9";

    /**
     * @var string
     */
    public string $cssOwnerName = "h4.css-1lcz6o7";

    /**
     * @var string
     */
    public string $cssClassTechnicalInformation = "ul.css-px7scb > li.css-1r0si1e > p ";

    /**
     * @var string
     */
    public string $cssClassAddId = "div[data-cy='ad-footer-bar-section'] > span.css-12hdxwj";

    /**
     * @var string
     */
    public string $cssClassImages = "div[data-cy='adPhotos-swiperSlide'] > div.swiper-zoom-container > img";

}
