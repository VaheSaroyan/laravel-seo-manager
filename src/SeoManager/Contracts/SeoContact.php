<?php

namespace Laravel\SeoManager\Contracts;


interface SeoContact
{
    /**
     * make seo fields
     * @param $keyword
     * @param $title
     * @param $description
     * @param null $image
     * @return mixed
     */
    public static function SeoManager($keyword, $title, $description, $image = null);

    /**
     * make page seo
     * @param $uri
     * @return mixed
     */
    public static function seoForAllPages($uri);

}
