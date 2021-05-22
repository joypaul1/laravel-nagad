<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NagadPayment;

class PaymentController extends Controller
{
  public function pay() {
    $redirectUrl = NagadPayment::tnxID(2)
             ->amount(22)
             ->getRedirectUrl();
      return redirect($redirectUrl);
  }
}
