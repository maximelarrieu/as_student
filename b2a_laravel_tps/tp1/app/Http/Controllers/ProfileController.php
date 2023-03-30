<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles/listProfiles')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();
        //var_dump('$user_id');
        $parameters = $request->except(['_token']);
        DB::table('profiles')->insert([
            'user_id' => $user_id,
            'last_name' => $parameters['last_name'],
            'first_name' => $parameters['first_name'],
            'age' => $parameters['age'],
            'phone_number' => $parameters['phone_number'],
            'address' => $parameters['address'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profiles/addProfiles');
    }
     public function showOne($id) {
        $profile = Profile::find($id);

        return view('profiles/showOneProfile')->with('profile', $profile);
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return void
     */
    public function update(Request $request, Profile $profile, $id)
    {
        $profile = Profile::find($id);
        $user_id = Auth::id();
        $parameters = $request->except(['_token']);
        DB::table('profiles')->where('id', $id)->update([
            'user_id' => $user_id,
            'last_name' => $parameters['last_name'],
            'first_name' => $parameters['first_name'],
            'age' => $parameters['age'],
            'phone_number' => $parameters['phone_number'],
            'address' => $parameters['address'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $profile->save();

        return redirect()->route('list')->with('success', "L'administrateur a bien été mis à jour !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile, $id)
    {
        $profile = Profile::find($id);
        DB::table('profiles')->where('id', '=', $id)->delete();
        return redirect()->route('list')->with('success', "L'administrateur a bien été supprimé !");
    }

    public function valid() {
        return redirect()->route('list')->with('success', "L'administrateur a bien été ajouté !");
    }

}
