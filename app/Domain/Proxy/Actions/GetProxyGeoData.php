<?php

namespace App\Domain\Proxy\Actions;

use Illuminate\Support\Facades\Http;

class GetProxyGeoData
{
    public function __construct()
    {
    }

    public function do($proxy)
    {
        // Получение геоданных
        $geoData = Http::get('http://ip-api.com/json/' . $proxy);
        $country = $geoData['country'] ?? null;
        $city    = $geoData['city'] ?? null;

        return [
            'country' => $country,
            'city'    => $city,
        ];
    }
}