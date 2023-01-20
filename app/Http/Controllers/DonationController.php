<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\DonationService;

class DonationController extends Controller
{
    public $donationService;

    public function __construct()
    {
        $this->donationService = new DonationService;
    }

    public function donatePage($username)
    {
        $user = (new UserService)->getAccountByUsernamen($username);
        if(!$user) return redirect('/')->with('error', 'Username not fount');
        return view('pages.donation.pay-donation', compact('user'));
    }

    public function payDonation(Request $request)
    {
        return $this->donationService->payDonation($request->all());
    }

    public function payDonationCallback()
    {
        return $this->donationService->payDonationCallback();
    }

    public function successDonationPage()
    {
        return view('pages.donation.success');
    }

}
