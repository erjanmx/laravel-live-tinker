<?php

Route::get('live-tinker', 'Erjanmx\LiveTinker\Controllers\LiveTinkerController@index');

Route::post('live-tinker/ajax', 'Erjanmx\LiveTinker\Controllers\LiveTinkerController@ajax');
