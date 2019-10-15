<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller {

//    /**
//     * Display a listing of the resource.
//     *
//     * @param Request $request
//     * @return \Illuminate\View\View
//     */
//    public function index(Request $request): \Illuminate\View\View
//    {
//        $users = User::orderBy('name', 'ASC')->paginate(10);
//
//        return view('users.index')
//            ->with('users', $users)
//            ->with('i', ($request->input('page', 1) - 1) * 10);
//    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\View\View
//     */
//    public function create(): \Illuminate\View\View
//    {
//        $roles = Role::pluck('name', 'name')->all();
//
//        return view('users.create', compact('roles'));
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [ 
            'message' => 'required'
        ]);

        $inputs = $request->all();
        $inputs['owner_id'] = $request->get('id');
        $inputs['user_id'] = auth()->id();

        Note::create($inputs);

        return redirect()->route('users.profile.show', $request->get('id'))
            ->with('success', 'Note created successfully');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     * @return \Illuminate\View\View
//     */
//    public function show($id): \Illuminate\View\View
//    {
//        $user = User::find($id);
//
//        return view('users.show', compact('user'));
//    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int $id
//     * @return \Illuminate\View\View
//     */
//    public function edit($id): \Illuminate\View\View
//    {
//        $user = User::find($id);
//        $roles = Role::pluck('name', 'name')->all();
//        $userRole = $user
//            ->roles
//            ->pluck('name')
//            ->all();
//
//        return view('users.edit', compact('user', 'roles', 'userRole'));
//    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @param  int $id
//     * @return \Illuminate\Http\RedirectResponse
//     * @throws \Illuminate\Validation\ValidationException
//     */
//    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
//    {
//        $user = User::find($id);
//        $input = $request->all();
//
//        $rules = [
//            'email'    => 'required|email|unique:users,email,' . $id,
//            'job'      => 'required',
//            'password' => 'same:confirm-password'
//        ];
//
//        $this->validate($request, $rules);
//
//        if (empty($input['password']))
//        {
//            $input = array_except($input, array('password'));
//        }
//
//        $user->update($input);
//        DB::table('model_has_roles')
//            ->where('model_id', $id)
//            ->delete();
//        $user->assignRole($input['roles']);
//
//        $success = 'User updated successfully';
//
//        return redirect()->route('users.index', compact('success'));
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Note $note): \Illuminate\Http\RedirectResponse
    {
        $note->delete();

        return redirect()->route('users.profile.index')->with('success', 'Note deleted successfully');
    }
}
