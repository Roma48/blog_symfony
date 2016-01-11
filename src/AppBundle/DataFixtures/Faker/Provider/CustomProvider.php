<?php

namespace AppBundle\DataFixtures\Faker\Provider;

class CustomProvider {

    /**
     * @param $name
     * @return string
     */
    public static function customSlug($name)
    {
        $slug = str_replace(' ', '-', $name);
        $slug = preg_replace('/[^A-Za-z\-]/', '', $slug);
        return strtolower($slug);
    }
}