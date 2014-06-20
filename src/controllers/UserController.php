<?php namespace Allegro\Auth\Controller;

class UserController extends \BaseController {

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make('auth::user.register');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $p1 = \Input::get('password');
            $p2 = \Input::get('password_r');
            if ('' === $p1 || '' === $p2 || $p1 !== $p2) {
                throw new \Exception('Passwords don\'t match');
            }

            \Sentry::createUser([
                'email'         => \Input::get('email'),
                'password'      => \Input::get('password'),
                'activated'     => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
        /* @var $ex \Exception */
        catch (\Exception $ex) {
            return \Redirect::route('user_register_show')
                ->withInput()
                ->with('error', $ex->getMessage());
        }

        return \Redirect::route('user_login_show')
                ->with('notice', 'User has been created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        return \View::make('auth::user.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        try {
            /* @var $user \Cartalyst\Sentry\Users\Eloquent\User */
            $user = \Sentry::getUser();

            $user->first_name = \Input::get('first_name');
            $user->last_name = \Input::get('last_name');

            if ('' !== \Input::get('password') . \Input::get('password_r')) {
                $p1 = \Input::get('password');
                $p2 = \Input::get('password_r');
                if ($p1 !== $p2) {
                    throw new \Exception('Passwords don\'t match');
                }
                $user->password = $p1;
                $logout = true;
            }
            if (!$user->update()) {
                throw new \Exception('Unable to update values');
            }
        }
        /* @var $ex \Exception */
        catch (\Exception $ex) {
            return \Redirect::route('user_edit_show')
                ->withInput()
                ->with('error', $ex->getMessage());
        }

        if (isset($logout)) {
            \Sentry::logout();
            return \Redirect::route('user_login_show')
                    ->with('notice', 'User has been updated, please log in again');
        }

        return \Redirect::back()
                ->with('notice', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        /* @var $user \Cartalyst\Sentry\Users\Eloquent\User */
        $user = \Sentry::getUser();
        $user->delete();
        \Sentry::logout();
        return \Redirect::route('user_login_show')
                ->with('notice', 'User has been deleted. Wanna check?');
    }
}
