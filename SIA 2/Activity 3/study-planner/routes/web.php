<?php

use App\Http\Controllers\StudyController;

Route::get('/', function () {
    return redirect()->route('studies.index');
});

Route::resource('studies', StudyController::class);
