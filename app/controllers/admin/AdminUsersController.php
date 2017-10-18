<?php

class AdminUsersController extends BaseController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */

    protected  $zone;

    protected $unit;

    public function __construct(User $user, Role $role, Permission $permission,Unit $unit, Zone $zone)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
        $this->zone = $zone;
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/users/title.user_management');

        // Grab all the users
        $users = $this->user->all();

        // Show the page
        return View::make('admin/users/index', compact('users', 'title'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // All roles
        $roles = $this->role->where('name', '!=', 'admin')->orderBy('created_at', 'DESC')->get();
        $positions = Position::all();

        // Get all the available permissions
        $permissions = $this->permission->all();

        // Selected groups
        $selectedRoles = Input::old('roles', array());

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

		// Title
		$title = Lang::get('admin/users/title.create_a_new_user');

		// Mode
		$mode = 'create';

        //Zones

        $units = $this->unit->all();


		// Show the page
		return View::make('admin/users/create_edit', compact('roles', 'permissions', 'selectedRoles', 'selectedPermissions', 'title', 'mode','units', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $rules = [
            'FirstName'=>'required',
           'LastName'=>'required',
           'email' =>'required|unique:users',
          // 'mobile'=>'required|between:10,13',
           'unit_id'=>'required',
//            'password'=>'required|min:4|same:password_confirmation',
//            'password_confirmation'=>'required|min:4|same:password',
        ];

        $valid = Validator::make(Input::all(), $rules);

        if ($valid->passes())
        {
            $this->user->first_name = Input::get('FirstName' );
            $this->user->last_name = Input::get('LastName');
            $this->user->mobile = Input::get('mobile' );
//            $this->user->address = Input::get('address' );
            $this->user->title = Input::get('title' );
            $this->user->unit_id = Input::get('unit_id' );
            $this->user->username = Input::get('FirstName')."_".Input::get('LastName');
            $this->user->email = Input::get( 'email' );
            $this->user->password = Hash::make( Str::upper(Input::get('LastName')));

        // Generate a random confirmation code
        $this->user->confirmation_code = md5(uniqid(mt_rand(), true));
  
        $this->user->confirmed =1;
 

        // Save if valid. Password field will be hashed before save

        $this->user->save();

        if ( $this->user->id ) {
            // Save roles. Handles updating.
            $this->user->saveRoles(Input::get( 'roles' ));

            // Redirect to the new user page
            return Redirect::to('admin/users')
                ->with('success', Lang::get('admin/users/messages.create.success'));

        }else{
            $error = $this->user->errors()->all();
            return Redirect::to('admin/users/create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );

        }
        } else {
            return Redirect::to('admin/users/create')
                ->withInput(Input::except('password'))
                ->withErrors($valid);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {
        if ( $user->id )
        {
            $roles = $this->role->where('name', '!=', 'admin')->orderBy('created_at', 'DESC')->get();
            $permissions = $this->permission->all();				

			$units = $this->unit->all();

            // Title
        	$title = Lang::get('admin/users/title.user_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/users/create_edit', compact('user', 'roles', 'permissions', 'title', 'mode','units'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return Response
     */
    public function postEdit($user)
    {
        $user = User::find($user->id);
		
		   $rules = [
           'FirstName'=>'required',
           'LastName'=>'required',
           'email' =>'required',
           'unit_id'=>'required',
     
        ];

        $valid = Validator::make(Input::all(), $rules);
				
        if ($valid->passes())
        {			
            $user->first_name = Input::get('FirstName' );
            $user->last_name = Input::get('LastName');
            $user->mobile = Input::get('mobile' );
            $user->address = Input::get('address' );
            $user->title = Input::get('title' );
            $user->unit_id = Input::get('unit_id' );
            $user->username = Input::get('FirstName')."_".Input::get('LastName');
            $user->email = Input::get( 'email' );
			
		 if ($user->save()) {
            // Save roles. Handles updating.
            $user->saveRoles(Input::get('roles'));
			
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')
                ->with('error', Lang::get('admin/users/messages.edit.error'));
        }
			return Redirect::to('admin/users')->with('success', Lang::get('admin/users/messages.edit.success'));
		}else{
     
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }
    }

    /**
     * Remove user page.
     *
     * @param $user
     * @return Response
     */
	 
    public function getDelete($user)
    {
        // Title
        $title = Lang::get('admin/users/title.user_delete');

        // Show the page
        return View::make('admin/users/delete', compact('user', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($user)
    {
        // Check if we are not trying to delete ourselves
        if ($user->id === Confide::user()->id)
        {
            // Redirect to the user management page
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.impossible'));
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        // Was the comment post deleted?
        $user = User::find($id);
        if ( empty($user) )
        {
            // TODO needs to delete all of that user's content
            return Redirect::to('admin/users')->with('success', Lang::get('admin/users/messages.delete.success'));
        }
        else
        {
            // There was a problem deleting the user
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.error'));
        }
    }
	
	
	   // Activate User

    public function activateUser($user){
      if(!empty($user)){
        $user->active = true;
        if($user->save()){
            return Redirect::back()->with('success',$user->first_name.' '.$user->last_name.' has been activated');
        }
    }else{
          return Redirect::back();
      }
    }

  //Deactivate User
    public function deactivateUser($user){
      if(!empty($user)){
        $user->active = false;
        if($user->save()){
            return Redirect::back()->with('success',$user->first_name.' '.$user->last_name.' has been deactivated');
        }
    }else{
          return Redirect::back();
      }
    }

  
     //Reset User Password

    public function resetUserPassword($id){
        $user = User::find($id);
        if($user != null){
            $user->password = Hash::make(strtoupper($user->last_name));
            $user->save();

            Session::flash('message', 'Password has been reset!');
            return Redirect::to('admin/users')->with('success','Password has been reset!');
        }
        return Redirect::to('admin/users');
    }

}
