<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MergedApiService
{
    private CacheInterface $cache;
    private string $dataPath;

    public function __construct(CacheInterface $cache, string $dataPath = '../public/data/')
    {
        $this->cache = $cache;
        $this->dataPath = $dataPath;
    }

    public function fetchAndMergeData(): array
    {
        return $this->cache->get('merged_properties', function (ItemInterface $item) {
            $item->expiresAfter(3600); // Cache data for 1 hour

            $api1Data = $this->loadJsonData('api1.json');
            $api2Data = $this->loadJsonData('api2.json');

            return $this->mergeData($api1Data, $api2Data);
        });
    }

    private function loadJsonData(string $fileName): array
    {
        $filePath = $this->dataPath . $fileName;

        if (!file_exists($filePath)) {
            error_log("Warning: JSON file '$filePath' is missing.");
            return [];
        }

        $content = file_get_contents($filePath);
        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    private function mergeData(array $api1Data, array $api2Data): array
    {
        $propertyMap = [];

        foreach ($api1Data as $item) {
            if (!isset($item['id'])) {
                continue;
            }
            $propertyMap[$item['id']] = $item;
        }

        foreach ($api2Data as $item) {
            if (!isset($item['id'])) {
                continue;
            }

            if (isset($propertyMap[$item['id']])) {
                $propertyMap[$item['id']] = array_merge($propertyMap[$item['id']], $item);
            } else {
                $propertyMap[$item['id']] = $item;
            }
        }

        return array_values($propertyMap);
    }
}
