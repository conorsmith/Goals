<?php namespace ConorSmith\Goals\Http\Controllers\Auth;

use Cache;
use Config;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Services\GoogleDrive;
use Request;

class OAuthController extends Controller {

    public function callback($service)
    {
        $client = (new GoogleDrive)->getClient();

        if (Request::has('code')) {
            $accessToken = $client->authenticate(Request::get('code'));
            Cache::put('google.access_token', $accessToken, 60);
        }

        return redirect(Config::get('app.url') . route('dashboard', [], false));

        return redirect()->route('dashboard');
    }

    public function trigger($service)
    {
        $drive = new GoogleDrive;
        return redirect($drive->getClient()->createAuthUrl());
    }

}
