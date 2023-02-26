<?php

namespace Database\Seeders;

use App\Events\Templates\Mails\ProcessUserEmailChangeEvent;
use App\Events\Templates\Sms\ProcessUserPhoneChangeEvent;
use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    public function run()
    {
        $this->createTemplates();
    }

    /**
     * Akcja dodająca szablony
     */
    public function createTemplates()
    {
        $templates = [
            [
                'event_name' => ProcessUserPhoneChangeEvent::class,
                'subject' => 'Process changing phone for user is start',
                'content' => 'Process changing phone for user is start',
            ],
            [
                'event_name' => ProcessUserEmailChangeEvent::class,
                'subject' => 'Process changing email for user is start',
                'content' => 'Process changing email for user is start',
            ],
        ];
        DB::transaction(function () use ($templates) {
            foreach ($templates as $template) {
                Template::firstOrCreate([
                    'event_name' => $template['event_name']
                ], [
                    'event_name' => $template['event_name'],
                    'subject' => $template['subject'],
                    'content' => $template['content'],
                ]);
            }
        });
    }
}
