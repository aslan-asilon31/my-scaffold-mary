<?php

use Illuminate\Support\Facades\Route;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;



Route::get('/login', \App\Livewire\Pages\AuthenticationResources\Login::class)->name('login');
