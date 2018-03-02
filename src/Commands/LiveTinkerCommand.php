<?php

namespace Erjanmx\LiveTinker\Commands;

use Workerman\Worker;
use Workerman\WebServer;
use Illuminate\Console\Command;

class LiveTinkerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live-tinker {code?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function initWorkers()
    {
        $ws = new Worker("websocket://0.0.0.0:2346");
        $server = new WebServer("http://0.0.0.0:2345");

        $ws->onMessage = function($connection, $data) {
            // using shell_exec to get code's live state
            $output = shell_exec("php artisan live-tinker '$data'");

            $connection->send($output ?? '');
        };

        $server->addRoot('127.0.0.1:2345', 'laravel-live-tinker/public');

        Worker::runAll();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = $this->argument('code');

        if ($code === null) {
            $this->initWorkers();

            return;
        }

        ob_start();

        try {
            echo eval($code);
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL . $e->getTraceAsString();
        }

        echo ob_get_clean();
    }
}
