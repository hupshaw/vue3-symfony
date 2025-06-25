<?php

namespace App\Service\ApiClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$cache = new FilesystemAdapter();

class Caching {

    public function saveStation($station) {
        
        $value = $cache->get('station', function (ItemInterface $item): string {
            $item->expiresAfter(3600);

            
            $computedValue = $station;

            return $computedValue;
        });

        echo $value; // $station

        // ... and to remove the cache key
        $cache->delete('station');
    }
}