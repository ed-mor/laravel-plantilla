<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Users/index', [
            'filters' => Request::all('buscar', 'status', 'eliminados'),
            'users' => Auth::user()->account->users()
                ->orderByStatus()
                ->orderByName()                
                ->filter(Request::only('buscar', 'status', 'eliminados'))
                ->latest()
                ->get()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'status' => $user->status,
                        'profile_photo_path' => $user->photoUrl(),
                        //'photo' => $user->profile_photo_path,
                        'deleted_at' => $user->deleted_at,
                    ];
                }),
            'cuenta' => $user->account->name
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        //dd($request);
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
            'status' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->users()->create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'status' => Request::get('status'),
            'profile_photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);

        return Redirect::route('users')->with('success', 'Usuario creado satisfactoriamente...');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user_a' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'profile_photo_path' => $user->photoUrl(),
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        //  Si es DEMO Cancela
        if (config('system.app_isDemo')) {
           return Redirect::back()->with('error', 'La actualización no está permitida en la versión DEMO');
        }
        //  Revisr que se cumpla la Política
            //  TODO
        //  Validación 
        $data = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'status' => ['required', 'boolean'],
            'profile_photo_path' => ['nullable', 'image'],
        ]);
        //  Asignando valores
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->status = $data['status'];

        //  Si el usuario sube una nueva imagen
        if (Request::file('profile_photo_path')) {
            //  Eliminamos la imagen anterior
            $imgOld = 'public/' . $user->profile_photo_path;
            Storage::delete($imgOld);
            //  Obtenemos la ruta de la nueva imagen
            $ruta_imagen = $data['profile_photo_path']->store('profile-photos','public');
            //  Actualizamos el string de la imagen para la BBDD
            $user->profile_photo_path = $ruta_imagen;
            //  Guardamos la nueva imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(300,300);
            $img->save();
        }

        $user->save();

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        //  Redireccionar
        return Redirect::back()->with('success', 'Usuario actualizado...');
    }

    public function deletePhoto(User $user)
    {
        if (config('system.app_isDemo')) {
            return Redirect::back()->with('error', 'La Eliminación de Usuarios, no es permitida en la versión DEMO...');
        }
        //  Eliminamos la foto 
        $imgOld = 'public/' . $user->profile_photo_path;
        Storage::delete($imgOld);
        $user->profile_photo_path = null;
        $user->save();
        //  Redireccionar
        return Redirect::back()->with('success', 'Foto Eliminada...');
    }

    public function destroy(User $user)
    {
        if (config('system.app_isDemo')) {
            return Redirect::back()->with('error', 'La Eliminación de Usuarios, no es permitida en la versión DEMO...');
        }
        //  Eliminamos la foto 
        //  $imgOld = 'public/' . $user->profile_photo_path;
        //  Storage::delete($imgOld);
        
        $user->delete();
        return Redirect::route('users')->with('success', 'Usuario eliminado...');
        //  return Redirect::back()->with('success', 'Usuario eliminado...');
    }

    public function restore(User $user)
    {
        $user->restore();
        return Redirect::back()->with('success', 'Usuario restaurado...');
    }

}

