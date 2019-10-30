<?php
namespace App\Http\Controllers\Social;
use App\Http\Controllers\Controller;
use Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
           $user->getId();
        echo $user->getNickname();
        echo $user->getName();
        echo $user->getEmail();
        echo "<img src='".$user->getAvatar()."'/>";
        $user->token;
    }
}