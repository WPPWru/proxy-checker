<?php

namespace App\Http\Controllers;

use App\Domain\Proxy\Actions\ProxyValidateFormat;
use App\Jobs\CheckProxyJob;
use Illuminate\Http\JsonResponse;

class ProxyCheckController extends Controller
{
    public function __construct(
        private readonly ProxyValidateFormat $proxyValidateFormat,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        // Получение данных из формы
        $proxies = request('proxies');
        if ( ! $proxies) {
            return response()->json([
                'error' => 'Вы не указали прокси',
            ], 400);
        }

        // Валидация формата прокси
        $validProxiesArray = $this->proxyValidateFormat->do($proxies);
        if ( ! $validProxiesArray) {
            return response()->json([
                'error' => 'Похоже, вы не указали ни одного прокси в верном формате',
            ], 400);
        }

        // Отправка прокси на проверку в очередь
        foreach ($validProxiesArray as $proxy) {
            CheckProxyJob::dispatch($proxy);
        }

        dd($validProxiesArray);


        $results = [
            'total'   => count($proxies),
            'success' => 0,
            'error'   => 0,
            'results' => [],
        ];

        return response()->json($results); // Отправка данных обратно в формате JSON
    }
}