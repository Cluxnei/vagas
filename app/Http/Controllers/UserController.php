<?php

namespace App\Http\Controllers;

use App\Mail\UserStatusChange;
use App\Models\Course;
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

    public function administratorEdit($id)
    {
        $administrator = User::administrator()->findOrFail($id);
        return view('users.administrators.edit', compact('administrator'));
    }

    public function administratorUpdate(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => ['required', 'string', 'min:11', 'max:14', 'unique:users'],
            'rg' => ['string', 'min:9', 'max:13', 'unique:users'],
            'course_id' => ['required'],
        ]);

        $data['cpf'] = preg_replace('/(\.)|(\-)/', '', $data['cpf']);
        $data['rg'] = preg_replace('/(\.)|(\-)/', '', $data['rg']);
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
        try {
            $user = User::findOrFail($id);
            $name = $user->name;
            $user->delete();
            $message = "{$name} deletado.";
            return redirect()->route('users.administrators')->with(['error' => false, 'message' => $message]);
        } catch (\Throwable $th) {
            $message = 'Usuário não encontrado.';
            if (isset($user)) {
                $hasJobs = $user->jobs()->count() != 0;
                $message = 'Esse usuário possue vagas associadas.';
            }
            return redirect()->route('users.administrators')->with(['error' => true, 'message' => $message]);
        }
    }
}
