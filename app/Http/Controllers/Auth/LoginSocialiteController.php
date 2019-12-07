<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Repositories\User\UserRepositoryInterface;

class LoginSocialiteController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToProvider($provider)
    {
        try {

            return Socialite::driver($provider)->redirect();
        } catch (\Exception $mess) {

            return back();
        }
    }

    public function handleProviderCallback($provider)
    {
        $userApi = Socialite::driver($provider)->stateless()->user();
        $user = $this->userRepository->getOrCreateUserProviderApi($userApi, $provider);
        auth()->login($user);

        return redirect()->route('home');
    }
}
