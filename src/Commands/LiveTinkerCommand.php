<?php

namespace Erjanmx\LiveTinker\Commands;

use Workerman\Worker;
use Workerman\WebServer;
use Illuminate\Console\Command;

class LiveTinkerCommand extends Command
{
    protected $webSocketIp;

    protected $webSocketPort;

    protected $webServerIp;

    protected $webServerPort;

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

        $this->webServerIp = env('LIVE_TINKER_SOCKET_IP', '0.0.0.0');
        $this->webServerPort = env('LIVE_TINKER_SOCKET_PORT', '2345');

        $this->webSocketIp = env('LIVE_TINKER_SERVER_IP', '0.0.0.0');
        $this->webSocketPort = env('LIVE_TINKER_SERVER_PORT', '2346');
    }

    public function initWorkers()
    {
        $ws = new Worker("websocket://{$this->webSocketIp}:{$this->webSocketPort}");
        $server = new WebServer("http://{$this->webServerIp}:{$this->webServerPort}");

        $ws->onMessage = function($connection, $data) {
            // using shell_exec to get code's live state
            // maybe set in config, either exec or native artisan call
            $output = shell_exec("php artisan live-tinker '$data'");

            $connection->send($output ?? '');
        };

        $server->addRoot("{$this->webServerIp}:{$this->webServerPort}", 'laravel-live-tinker/public');

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
