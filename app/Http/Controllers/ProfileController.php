<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index(){
        $users = User::all();
        return view('profile.list-user',['users'=>$users]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   
        $user = User::find($request->route('profile'));
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
       $user = User::find($request->route('profile')); 
       $user->update($request->all());
       return redirect()->route('profile.index')
            ->with('success', 'Usuario atualizado com sucesso.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = User::find($request->user_id);
        $user->delete();
        return Redirect::route('profile.index')->with('success','Usuario Apagado com sucesso');
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required']
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'integrationHash' => Str::random(40),
                'profile_image_path'=>null,
                'role'=> $request->role
            ]);

            DB::commit();

            return Redirect::route('profile.index')->with('status', 'user-created');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar usuário. Por favor, tente novamente.'])->withInput();
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', ['user' => $user]);
    }
}
