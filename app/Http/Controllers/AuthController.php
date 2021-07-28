<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\UsersInfo;
use App\Orangebd\Network;
use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller
{
    use Network;

    public function login(Request $request)
    {
        if(!$this->validNetwork())
            return redirect(config('app.url').'error?type=unauthorized-network');

        if(!empty(session()->get('user')))
            return redirect(config('app.url'));

        $title = 'Login';
        return view('auth.login', compact(['title']));
    }

    public function auth(Request $request){

        if(!$this->validNetwork())
            return redirect(config('app.url').'error?type=unauthorized-network');

        if($request->isMethod('post')) {
            $user = Users::where('user_id', $request->user_id)
                ->orWhere('email', $request->user_id)
                ->orWhere('mobile', $request->user_id)->limit(1)->get()->toArray();
            if (!empty($user)) {
                $user = $user[0];
                //Check Manually
                if (\Hash::check($request->password, $user['password'])) {
                    $userInfo = UsersInfo::find($user['id'])->get()->toArray();
                    $user = array_merge($user, $userInfo[0]);

                    unset($user['password']);
                    unset($user['created_at']);
                    unset($user['updated_at']);

                    session()->put('user', $user);
                    if (isset($request->uri_redirect))
                        return redirect($request->uri_redirect);
                }
            }
        }
        return redirect(config('app.url'));
    }

    public function logout(Request $request)
    {
        if(!$this->validNetwork())
            return redirect(config('app.url').'error?type=unauthorized-network');

        if(\Auth::check())
        {
            \Auth::logout();
            $request->session()->invalidate();
        }
        session()->flash('user');
        return redirect(config('app.url').'login');
    }
}