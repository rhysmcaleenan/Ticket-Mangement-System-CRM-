<?php

namespace App\Http\Controllers;

use App\Traits\Uploadable;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    use uploadable;

    /**
     * Display a listing of the users.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $users = User::orderBy('name', 'ASC')->paginate(10);

        return view('users.index')
            ->with('users', $users)
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'job'      => 'required',
            'roles'    => 'required'
        ]);

        $input = $request->all();

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user
            ->roles
            ->pluck('name')
            ->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $input = $request->all();

        $rules = [
            'email'    => 'required|email|unique:users,email,' . $id,
            'job'      => 'required',
            'password' => 'same:confirm-password'
        ];

        $this->validate($request, $rules);

        if (empty($input['password'])) {
            $input = array_except($input, array('password'));
        }

        $user->update($input);
        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();
        $user->assignRole($input['roles']);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        $success = 'User deleted successfully';

        return redirect()->route('users.index', compact('success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function profileShow(User $user): View
    {
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function profileEdit(): View
    {
        $user = auth()->user();

        return view('users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function profileUpdate(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $inputs = $request->all();

        $rules = [
            'email'    => 'required|email|unique:users,email,' . $user->id,
//            'job'      => 'required',
            'password' => 'same:confirm-password'
        ];

        $this->validate($request, $rules);

        if (empty($inputs['password'])) {
            $inputs = array_except($inputs, array('password'));
        }

        if ($request->hasFile('file')) {
            $inputs['image'] = $this->uploadOne($request->file('file'), 'uploads/profiles');
        }

        $user->update($inputs);

        return redirect()->route('users.profile.index')
            ->with('success', 'Profile updated successfully');
    }
}
