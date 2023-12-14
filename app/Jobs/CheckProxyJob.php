<?php

namespace App\Jobs;

use App\Domain\Proxy\Actions\CheckOneProxy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckProxyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $proxy,
        private readonly CheckOneProxy $checkOneProxy,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Логика проверки прокси
        $this->checkOneProxy->do($this->proxy);
    }
}
