<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Role;
use App\Photo;

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
        $roles = Role::pluck('name', 'id')->toArray();

        //dd($roles);

        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if(trim($request['password']) == '') {
            $input = $request->except(['password']);/* ->except(),  WILL IGNORE THE FIELD AND
                                                    MAKE IT AS AN ERROR "The password field is required." */
        } else {
            $input = $request->all();
        }

        if ($file = $request['path']) {
            $time = str_replace([' ', ':', '-'], '_', Carbon::now());
            $name = $time . "_" . $file->getClientOriginalName();
            $file->move(public_path()."/images/", $name);

            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;
            User::create($input);

            return redirect()->route('admin.users.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $roles = Role::pluck('name', 'id')->toArray();

        return view('admin.users.edit', compact('user', 'roles'));
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
        /* UNLINK/DELETE photo before upload a new photo to user */
        unlink(public_path() . $user->photo->path);//DELETE REAL IMAGE(public/images/)
        Photo::findOrFail($user->photo_id)->delete();

        if(trim($request['password']) == '') {
            $input = $request->except(['password']);/* ->except(),  WILL IGNORE THE FIELD AND
                                                    MAKE IT AS AN ERROR "The password field is required." */
        } else {
            $input = $request->all();
        }

        if($path = $request['path']) {
            $time = str_replace([' ', ':', '-'], '_', Carbon::now());
            $name = $time . "_" . $path->getClientOriginalName();

            $path->move(public_path() . "/images/", $name);
            $photo = Photo::create(['path' => $name]);

            $input['photo_id'] = $photo->id;
            $user->update($input);

            Session::flash('update_user_msg', 'User has been updated!');

            return redirect()->route('admin.users.index');
        }
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
        /* UNLINK/DELETE PHOTO FIRST BECAUSE WE NEED TO ACCESS $user->photo_id */
        unlink(public_path() . $user->photo->path);//DELETE REAL IMAGE(public/images/)
        Photo::findOrFail($user->photo_id)->delete();
        $user->delete();

        Session::flash('delete_user_msg', 'User has been deleted!');

        return redirect()->route('admin.users.index');
    }
}
