<?php

namespace App\Console\Commands;

use App\Services\Contracts\IcsServiceContract;
use Illuminate\Console\Command;

class IcsGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ics:generate {--year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate ics file from schedule params, default current year';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        IcsServiceContract $icsService
    )
    {
        $year = $this->option('year') ?: today()->format('Y');
        $icsService->generate($year);
        return Command::SUCCESS;
    }
}
