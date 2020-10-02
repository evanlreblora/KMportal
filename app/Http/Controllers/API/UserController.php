<?php

namespace App\Http\Controllers\API;

use Error;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "email" => "required|unique:users|max: 100",
            "password" => "required|string|min:4|max:100"
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'bio' => $request['bio'],
            'type' => $request['type'],
            'photo' => $request['photo'] ?? 'profile.png',
        ]);
    }
    /**
     * Display the auth resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * update the auth resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $extension = explode('/', mime_content_type($request->photo))[1];
        $name = uniqid('img_').'.'.$extension;
        Image::make($request->photo)->resize(128,128)->save(public_path('img/profile/').$name);
        return $name;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "email" => "required|max:110|unique:users,email,".$user->id,
            "password" => "sometimes|string|min:4|max:100"
        ]);

        if($request->password){
            $request->password = Hash::make($request->password);
        }

        $user->update( $request->all() );
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // throw new Error("Cannot be deleted");
        $user->delete();
        return response()->json($user);
    }
}
