<?php

use Illuminate\Support\Facades\Route;
use App\Mail\SendEmail;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Mail;

// Route::get('/send-email',function(){
//     $data = [
//         'name' => 'Aslan',
//         'body' => 'tes kirim email'
//     ];
   
//     Mail::to('sulaslansetiawan3@gmail.com')->send(new SendEmail($data));
   
//     dd("Email Berhasil dikirim.");
// });
