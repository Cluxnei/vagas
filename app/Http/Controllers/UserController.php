<?php

namespace App\Http\Controllers;

use App\Mail\UserStatusChange;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private function notify(User $user)
    {
        Mail::to($user->email)->send(new UserStatusChange($user));
    }
    public function approve($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'approved' => 1,
            ]);
            $this->notify($user);
            return redirect()->back()->with(['error' => false, 'message' => 'Usuário aprovado']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => true, 'message' => 'Erro ao aprovar usuário']);
        }
    }
    public function reject($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'approved' => 0,
            ]);
            $this->notify($user);
            return redirect()->back()->with(['error' => false, 'message' => 'Usuário rejeitado']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => true, 'message' => 'Erro ao rejeitar usuário']);
        }
    }
    public function administratorsIndex()
    {
        $administrators = User::administrator()->get();
        return view('users.administrators.index', compact('administrators'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::notAdmistrator()->orderBy('approved', 'asc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
