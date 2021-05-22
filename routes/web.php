<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('payment','PaymentController@pay');

Route::get('payment-success',function(){
  $verify = (object) NagadPayment::verify();
  if($verify->status === 'Success'){
      $order = json_decode($verify->additionalMerchantInfo);
      $order_id = $order->tnx_id;
      // your functional task with order_id
      return redirect('shop');
  }
  if ($verify->status === 'Aborted') {
      dd($verify);
      // redirect or other what you want
  }

});


Route::get('get-support-id',function(){
    $sid = NagadPayment::tnxID(1)
                 ->amount(100)
                 ->getSupportID();
    return $sid;
});
