<?php namespace Allegro\Auth\Controller;

class SessionController extends \BaseController {

    /**
     * Show the login page
     * @return View
     */
    public function create()
    {
        return \View::make('auth::session.login');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store()
    {
        $credentials = [
            'email'        => \Input::get('email'),
            'password'     => \Input::get('password'),
        ];
        $remember = \Input::get('remember') === '1';

        try {
            \Sentry::authenticate($credentials, $remember);
        }
        catch (\Exception $ex) {
            $msg = $ex instanceof \Cartalyst\Sentry\Throttling\UserSuspendedException
                    ? $ex->getMessage()
                    : 'Invalid credentials';

            return \Redirect::back()
                    ->withInput()
                    ->with('error', $msg);
        }

        // Extract requested page from session
        $redirect = \Session::get('loginRedirect', \URL::route('user_edit_show'));
        \Session::forget('loginRedirect');

        return \Redirect::to($redirect);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @return Response
    */
    public function destroy()
    {
        \Sentry::logout();
        \Session::flash('notice', 'Session closed');
        return \Redirect::back();
    }

}
