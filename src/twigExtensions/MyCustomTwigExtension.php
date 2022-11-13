<?php

namespace App\twigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtension extends AbstractExtension{
    public function getFilters(){
        return[
            new TwigFilter('defaultImage' , [$this, 'defaultImage'])
        ];
    }
    public function defaultImage(string $path): string {
        if(!file_exists($path)){
            return 'as.jpg';
        }
        return $path;
    }
}