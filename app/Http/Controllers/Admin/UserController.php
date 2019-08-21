<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.list', compact('users'));
    }


    public function list()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'username'  => 'required|unique:users,username',
            'email'     => 'required|unique:users,email',
            'area'      => 'required|in:administracion,comercial,farmacia',
            'state'     => 'required'
            ]);

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->username  = $request->username;
        $user->email     = $request->email;
        $user->area      = $request->area;
        $user->state     = $request->state;
        $user->password  = bcrypt('123456');

        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $user =  User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $user = User::findOrFail($id);
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
        $this->validate($request, [
            'firstname' => 'required|min:3',
            'lastname'  => 'required|min:3',
            'username'  => 'required|unique:users,username,' . $id,
            'email'     => 'required|unique:users,email,' . $id,
            'area'      => 'required|in:administracion,comercial,farmacia'
            ]);

        User::findOrFail($id)->update($request->all());

        return;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $users = User::where('username','like','%'.$query.'%')->get();
        return response()->json($users);
    }

    public function active($id)
    {
        $user = User::findOrFail($id);

        $user->state = !$user->state;

        $user->save();

        $users = User::orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    public function crear_rol(Request $request)
    {
       $rol=new Role;
       $rol->name=$request->input("rol_nombre") ;
       $rol->slug=$request->input("rol_slug") ;
       $rol->description=$request->input("rol_descripcion") ;
       $rol->save();
    }
}
