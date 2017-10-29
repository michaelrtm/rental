<?php

Route::get('/pumps/{pump}', 'PumpsController@show');

Route::get('/bookings/{booking}', 'BookingsController@show');
