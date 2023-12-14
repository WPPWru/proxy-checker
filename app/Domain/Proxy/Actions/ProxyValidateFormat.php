<?php

namespace App\Domain\Proxy\Actions;

class ProxyValidateFormat
{
    public function __construct()
    {
    }

    public function do($proxies): array
    {
        $proxies      = explode("\n", $proxies);
        $validProxies = [];

        foreach ($proxies as $proxy) {
            $proxy = trim($proxy); // Удаление лишних пробелов

            // Проверка формата прокси. Валидным считается прокси в формате IP:PORT
            if (preg_match('/^(\d{1,3}\.){3}\d{1,3}:\d{1,5}$/', $proxy)) {
                // Добавление прокси в массив валидных прокси
                $validProxies[] = $proxy;
            }
        }

        return $validProxies;
    }
}