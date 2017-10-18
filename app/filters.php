<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if ( Auth::guest() ) // If the user is not logged in
	{
        	return Redirect::guest('user/login');
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('user/login/');
});

Route::filter('supermanager', function()
{
	if ( Auth::user()->hasRole('supermanager')==false ) // If the user is  not supermanager
	{
        	return Redirect::to('dashboard')->with('warning','You dont have permission to view the requested page');
	}
});

/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/

// Check for role on all admin routes
//Entrust::routeNeedsRole('admin*', array('supermanager'), Redirect::to('myDashboard')->with('warning','You dont have permission to view the requested page'));

// Check for permissions on admin actions
//Entrust::routeNeedsPermission( 'admin/blogs*', 'manage_blogs', Redirect::to('/admin') );

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::getToken() !== Input::get('csrf_token') &&  Session::getToken() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
|
| Detect the browser language.
|
*/

Route::filter('detectLang',  function($route, $request, $lang = 'auto')
{

    if($lang != "auto" && in_array($lang , Config::get('app.available_language')))
    {
        Config::set('app.locale', $lang);
    }else{
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
        $browser_lang = substr($browser_lang, 0,2);
        $userLang = (in_array($browser_lang, Config::get('app.available_language'))) ? $browser_lang : Config::get('app.locale');
        Config::set('app.locale', $userLang);
        App::setLocale($userLang);
    }
});



/*
|--------------------------------------------------------------------------
| Logs
|--------------------------------------------------------------------------
|
| Log user and sql queries .
|
*/
if (Config::get('database.log', true)) {
Event::listen('illuminate.query', function($sql,$bindings,$url,$user)
{
	
	$type = explode(' ',$sql);
	if(in_array($type[0],array('insert','update','delete'))){ 
	
	$url = Request::url();
	$ip = Request::ip();
	$user = Auth::user()->first_name ." ". Auth::user()->last_name; 
	$data = compact('url','user','ip');

        // Format binding data for sql insertion
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else if (is_string($binding)) {
                $bindings[$i] = "'$binding'";
            }
        }

        // Insert bindings into query
        $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
        $sql = vsprintf($sql, $bindings);
			
		 Log::info($sql,$data);
	}

});
}

