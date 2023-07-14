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
        $deviceKey = $deviceKeyRepository->query()->first();
//        $key = 'dGhLqE7RXLj06jF9v5cBIy:APA91bGAKES7XW617WxhnMDSoiFldFjMuNmAMfio5db9z6KQnvajTXlOTk1qWWEMINh1NSsbKkaUiftDZVyRCuodTXEFWKkzxJvLgk511jZ5M_snmmUM-UEkcEYW1ZdVMy48QITvqw0M';
        $key = 'CnjR1jBJluwjvBozrxiOe:APA91bHLPSbn|4rn9A-a4R_dR2JuiP×5ET-zvilKxyqk8CBYpQlj7C27-6Gs6-SmVcEYLi9ZkDho49HKDPcMd6DjgSBETBY5rNazO';
        $pushMessageService->sendPush($key, 'Przypomnienie o śmieciach', 'Przypominam sie o śmieciach.');
        return Command::SUCCESS;
    }
}
