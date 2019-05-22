<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{

    function __construct()
    {
//        $this->middleware('permission:User-list');
//        $this->middleware('permission:Change-username', ['only' => 'edit','update']);
//        $this->middleware('permission:Change-username', ['only' => 'edit','update']);
        $this->middleware('permission:User-create', ['only' => ['create','store']]);
//        $this->middleware('permission:User-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:User-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(auth()->user()->can('User-list') )
        {
            $data = User::orderBy('id','DESC')->paginate(5);
        }
        elseif (auth()->user()->can('Change-username') || auth()->user()->can('Change-password'))
        {
            $data = User::where('email', auth()->user()->email)->get();
        }
        else
            {
            return abort(403);
        }

        return view('users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->has('current-password')){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'roles' => 'required'
            ]);
        }


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);

        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $editwhat)
    {

        if(auth()->user()->can('User-edit') || auth()->user()->can('Change-password') || auth()->user()->can('Change-username'))
        {

            $user = User::find($id);
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();


            if($editwhat == 'password')
            {
                if(auth()->user()->can('User-edit') || auth()->user()->can('Change-password'))
                {
                    return view('users.edit',compact('user','roles','userRole'), compact('editwhat'));
                }
                return abort(403);
            }
            elseif ($editwhat == 'username')
            {
                if(auth()->user()->can('User-edit') || auth()->user()->can('Change-username'))
                {
                    return view('users.edit',compact('user','roles','userRole'), compact('editwhat'));
                }
                return abort(403);
            }
            else
                {
                return abort(404);
            }

        }else{
            return abort(403);
        }



    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->has('password'))
        {
            $this->validate($request, [
                'name' => '',
                'email' => 'required|email|unique:users,email,'.$id,
                'current-password' => 'required',
                'password' => 'same:confirm-password|different:current-password',
                'roles' => ''
            ]);
        }else
            {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'roles' => 'required'
            ]);
        }

        $input = $request->all();

        if(!empty($input['password'])){

            $current_password = Auth::User()->password;

            if(Hash::check($input['current-password'], $current_password))
            {
                if(!Hash::check($input['password'], $current_password))
                {
                    $input['password'] = Hash::make($input['password']);
                }else{
                    return redirect()->back()->with('failed', ' Can\' use the old pass as the new password');
                }
            }else{
                return redirect()->back()->with('failed', ' Current password doesn\'t Match with the old one');
            }

        }else{
            $input = Arr::except($input,array('password'));
        }

        if(empty($input['name']))
        {
            $input = Arr::except($input,array('name'));
        }

        $user = User::find($id);

        $user->update($input);

        if(!empty($input['roles']))
        {
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }



        return redirect()->route('users.index')->with('success','User updated successfully');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(User::count() > 1)
        {
            $user = User::find($id)->delete();

            return redirect()->route('users.index')->with('success','User deleted successfully');
        }

        return redirect()->back()->withInput(Input::except('password'))->with('failed', ' Can\'t delete the only user account' );

    }
}