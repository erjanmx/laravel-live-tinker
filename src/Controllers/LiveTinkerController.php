<?php

namespace Erjanmx\LiveTinker\Controllers;


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
        eval($request->post('code'));
    }
}
