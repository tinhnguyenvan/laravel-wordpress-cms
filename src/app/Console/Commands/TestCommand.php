<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
       $telegram = new TelegramService();
       $telegram->send('demo');
    }
}
