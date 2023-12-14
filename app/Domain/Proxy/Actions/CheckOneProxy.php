<?php

namespace App\Domain\Proxy\Actions;

use App\Models\ProxyCheckResult;

readonly class CheckOneProxy
{
    public function __construct(
        private GetProxyGeoData $getProxyGeoData,
    ) {
    }

    public function do(string $proxy): void
    {
        // Тестовый URL
        $testUrl = 'https://ya.ru';

        // Типы прокси
        $proxyTypes = [
            CURLPROXY_SOCKS5 => 'SOCKS5',
            CURLPROXY_SOCKS4 => 'SOCKS4',
            CURLPROXY_HTTPS  => 'HTTPS',
            CURLPROXY_HTTP   => 'HTTP',
        ];

        // Проверка типа прокси
        foreach ($proxyTypes as $proxyType => $typeName) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $testUrl);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_PROXYTYPE, $proxyType);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $startTime  = microtime(true);
            $result     = curl_exec($ch);
            $proxySpeed = microtime(true) - $startTime;
            $curlError  = curl_error($ch);

            curl_close($ch);

            // Успешное соединение
            if ($result) {
                // Получение геоданных (страна, город)
                [$country, $city] = $this->getProxyGeoData->do($proxy);

                // Получение внешнего IP
                $externalIP = $this->getExternalIP->do($proxy);

                // Сохраняем результаты в базу данных
                ProxyCheckResult::create([
                    'proxy'       => $proxy,
                    'is_worked_status'   => true,
                    'type'        => $typeName,
                    'country'     => $country,
                    'city'        => $city,
                    'speed'       => $proxySpeed,
                    'external_ip' => $externalIP,
                ]);

                // Выход из цикла после успешного соединения
                break;
            }
            // В случае ошибки, цикл продолжится со следующим типом прокси
        }

        // Все попытки соединения неудачны
        if ( ! $result) {
            // Обработка неудачного случая
            ProxyCheckResult::create([
                'proxy'       => $proxy,
                'is_worked_status'      => false,
                'type'        => 'unknown',
                'country'     => 'unknown',
                'city'        => 'unknown',
                'speed'       => 'unknown',
                'external_ip' => 'unknown',
            ]);
        }
    }

}