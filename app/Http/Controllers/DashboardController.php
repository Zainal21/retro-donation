<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Services\DonationService;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Requests\AmountSettingRequest;
use App\Http\Requests\ChangePasswordRequest;

class DashboardController extends Controller
{
    public $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        $donation = (new DonationService)->getCountStaticticDonation();
        return view('pages.dashboard.index', compact('donation'));
    }

    public function profile()
    {
        $user = $this->userService->getAccountSignIn();
        return view('pages.profile.index', compact('user'));
    }

    public function updateSocialMedia(SocialMediaRequest $request)
    {
        $userId = Auth::user()->id;
        $data = $request->validated();
        $action = $this->userService->updateUserSocialMedia($data, $userId);
        return redirect()->back()->with(  
            $action ? 'success' : 'error', 
            $action ? 'User Social Media Updated': 'User Social Media Cannot Updated'
        );
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $currentPassword = $this->userService->checkCurrentPassword($request['current_password']);
        if ($currentPassword) {
            $action = $this->userService->changePassword($request['new_password']);
            return redirect()->back()->with(  
                $action ? 'success' : 'error', 
                $action ? 'User Password Updated': 'User Password Cannot Updated'
            );
        }else{
            return redirect()->back()->with('error','Invalid Current Password');
        }
    }

    public function updateAmountSetting(AmountSettingRequest $request)
    {
        $userId = Auth::user()->id;
        $data = $request->validated();
        $data['amount_1'] = Helper::priceToNumber($data['amount_1']);
        $data['amount_2'] = Helper::priceToNumber($data['amount_2']);
        $data['amount_3'] = Helper::priceToNumber($data['amount_3']);
        $action = $this->userService->updateUserAmount($data, $userId);
        return redirect()->back()->with(
            $action ? 'success' : 'error', 
            $action ? 'User Amount Updated': 'User Amount Cannot Updated'
        );
    }

    public function updateProfile(ProfileRequest $request)
    {
        $userId = Auth::user()->id;
        $data = $request->validated();
        $action = $this->userService->updateUserData($data, $userId);
        return redirect()->back()->with(
            $action ? 'success' : 'error', 
            $action ? 'Profile Updated': 'Profile Cannot Updated'
        );
    }
}
