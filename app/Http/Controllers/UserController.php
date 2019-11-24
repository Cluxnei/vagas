<?php

namespace App\Http\Controllers;

use App\Mail\UserStatusChange;
use App\Models\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
        } catch (Throwable $th) {
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
        } catch (Throwable $th) {
            return redirect()->back()->with(['error' => true, 'message' => 'Erro ao rejeitar usuário']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::notAdmistrator()->orderBy('approved', 'asc')->get();
        return view('users.index', compact('users'));
    }
    public function administratorsIndex()
    {
        $administrators = User::administrator()->get();
        return view('users.administrators.index', compact('administrators'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validateArray = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cpf' => ['required', 'string', 'min:11', 'max:14'],
            'rg' => ['string', 'min:9', 'max:13']
        ];
        $data = $request->validate($validateArray);
        $data['cpf'] = preg_replace('/(\.)|(\-)/', '', $data['cpf']);
        $data['rg'] = preg_replace('/(\.)|(\-)/', '', $data['rg']);
        $user->update($data);
        return redirect()->route('users.administrators')->with(['error' => false, 'message' => "{$request->name} atualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $name = $user->name;
            $user->delete();
            $message = "{$name} deletado.";
            return redirect()->route('users.administrators')->with(['error' => false, 'message' => $message]);
        } catch (Throwable $th) {
            $message = 'Usuário não encontrado.';
            if (isset($user)) {
                $hasJobs = $user->jobs()->count() != 0;
                if($hasJobs) $message = 'Esse usuário possue vagas associadas.';
            }
            return redirect()->route('users.administrators')->with(['error' => true, 'message' => $message]);
        }
    }
}
