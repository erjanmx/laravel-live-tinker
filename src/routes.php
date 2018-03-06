<?php

Route::get('live-tinker', 'Erjanmx\LiveTinker\src\Controllers\LiveTinkerController@index');

Route::post('live-tinker/ajax', 'Erjanmx\LiveTinker\src\Controllers\LiveTinkerController@ajax');
