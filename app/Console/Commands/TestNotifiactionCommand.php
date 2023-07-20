<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\DeviceKeyRepositoryContract;
use App\Services\Contracts\PushMessageServiceContract;
use Illuminate\Console\Command;

class TestNotifiactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        PushMessageServiceContract $pushMessageService,
        DeviceKeyRepositoryContract $deviceKeyRepository
    )
    {
        $deviceKeys = $deviceKeyRepository->query()->get();
        foreach ($deviceKeys as $deviceKey) {
            $this->output->info('key: ' . $deviceKey->device_key);
            $pushMessageService->sendPush($deviceKey, 'Przypomnienie o śmieciach', 'Przypominam sie o śmieciach.');
        }

        return Command::SUCCESS;
    }
}
