<?php

namespace App\Http\Controllers;

use App\Domain\Proxy\Actions\ProxyValidateFormat;
use App\Jobs\CheckProxyJob;
use App\Models\ProxyCheckResult;
use Illuminate\Http\JsonResponse;

class ProxyCheckResultsController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(): JsonResponse
    {
        // Получение последних 10 результатов
        $results = ProxyCheckResult::latest()->limit(10)->get();

        return response()->json($results);
    }
}