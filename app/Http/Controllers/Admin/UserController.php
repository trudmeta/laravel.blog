<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = config('app.perpage');
        return view('admin.users.index', [
            'users' => User::paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', auth()->user());

        return view('admin.users.create', [
            'roles' => Role::get()->pluck('name','id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', auth()->user());

        $user = User::create($request->only(['first_name', 'last_name', 'login', 'email', 'birthday', 'password']));
        $user->roles()->sync(2);

        return redirect()->route('admin.users.edit', $user)->withSuccess(__('User created'));
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
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::get()->pluck('name','id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        $data = [
            'first_name' => !empty($request->first_name)? $request->first_name : $user->first_name,
            'last_name' => !empty($request->last_name)? $request->last_name : $user->last_name,
            'login' => !empty($request->login)? $request->login : $user->login,
            'email' => !empty($request->email)? $request->email : $user->email,
            'birthday' => !empty($request->birthday)? $request->birthday : $user->birthday,
        ];

        if (isset($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);
        if(isset($validated['role'])){
            $user->roles()->sync($validated['role']);
        }

        return redirect()->route('admin.users.edit', $user)->withSuccess(__('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.users.index')->withSuccess(__('Deleted'));
    }
}
