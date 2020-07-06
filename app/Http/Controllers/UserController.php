<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if ($buscar=='') {
            $users = User::orderBy('name','asc')->paginate(5);
        } else {
            $users = User::where('name', 'like','%'. $buscar . '%')->orderBy('name','asc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];
        
        
        //return $users;
 
    }

    public function store(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }


    public function update(Request $request)
    {
        //

        $user = User::findOrFail($request->id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function delete(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $id = $request->id;
        User::where('id', '=', $id)->delete();
        //DB::table('users')->where('id', '=', $id)->delete();
    }

    public function getProductId(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $users = User::where('id','=', $id)
        ->select->orderBy('name', 'asc')->take(1)->get();

        return ['users' => $users];
    }
}
