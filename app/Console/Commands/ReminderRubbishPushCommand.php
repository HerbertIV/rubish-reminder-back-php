<?php

namespace App\Console\Commands;

use App\Enums\ReceiverTypes;
use App\Services\Contracts\ScheduleServiceContract;
use Illuminate\Console\Command;

class ReminderRubbishPushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder-rubbish:push-send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command send push message for devices.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        ScheduleServiceContract $scheduleService
    )
    {
        $scheduleService->reminderSchedule(ReceiverTypes::PUSH);
        return Command::SUCCESS;
    }
}
