<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$roles = Role::lists();
        $roles = Role::pluck('name','id')->all();


        return view('admin.users.create', compact('roles'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

       if(trim($request->password) == '') { //to check first if the password is empty or not

            $input = $request->except('password'); // if all the $input is requested, except the password, then:
            //$input = $request->only('password', 'username', 'photo_id');

        } else {

             $input = $request->all();
        }




       if($file = $request->file('photo_id')) {

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name); //will create an "images" folder in public directory

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;
        //return "photo exist";
       }

       $input['password'] = bcrypt($request->password); // to encrypt the pwd at database

       User::create($input);

       return redirect ('/admin/users');

        //User::create($request->all());

        //return $request -> all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        Session::flash('updated_user', 'The User has been updated');
    //============================================================================//
       if(trim($request->password) == '') { //to check first if the password is empty or not

            $input = $request->except('password'); // if all the $input is requested, except the password, then:
            //$input = $request->only('password', 'username', 'photo_id');

        } else {

             $input = $request->all();
        }
    //============================================================================//
        if ($file = $request->file('photo_id')) {    //to checking for the files

            $name = time() . $file->getClientOriginalName(); //add/change the image file name into a unique name

            $file->move('images', $name); //to move the file to a folder called "images" and create a name

            $photo = Photo::create(['file'=>$name]); //create a photo

            $input['photo_id'] = $photo->id; //grab the 'photo_id' as $photo -> id
        }

       $input['password'] = bcrypt($request->password); // to encrypt the pwd at database

        $user->update($input); // for $user to update it

        return redirect('/admin/users'); // to redirect the page
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user = User::findOrFail($id);

       if ($user->photo->file) {
         unlink(public_path() . $user->photo->file);
         $user->delete();
         Session::flash('deleted_user', 'The User has been deleted');
       } else {
         $user->delete();
          Session::flash('deleted_user', 'The User has been deleted');
       }
       return redirect('/admin/users');
    }
}
