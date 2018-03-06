<?php

namespace Erjanmx\LiveTinker\src\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveTinkerController extends Controller
{
    public function index()
    {
        return view('live-tinker::index');
    }

    public function ajax(Request $request)
    {
        $code = $request->post('code');

        ob_start();

        try {
            echo eval($code);
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL . $e->getTraceAsString();
        }

        echo ob_get_clean();
    }
}
