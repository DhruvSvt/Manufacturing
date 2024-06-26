<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Query Parameters */
        $keyword = request()->keyword;
        $rows = request()->rows ?? 25;

        if ($rows == 'all') {
            $rows = User::count();
        }

        // Get the table columns
        $allColumns = Schema::getColumnListing((new User())->getTable());
        $allRolesColumns = Schema::getColumnListing((new Roles())->getTable());

        $users = User::with('roles')
            ->when(isset($keyword), function ($query) use ($keyword, $allColumns, $allRolesColumns) {
                $query->where(function ($query) use ($keyword, $allColumns) {
                    // Dynamically construct the search query
                    foreach ($allColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            "%$keyword%"
                        );
                    }
                });

                // searching from suppliers
                $query->orWhereHas('roles', function ($query) use ($keyword, $allRolesColumns) {
                    $query->where(function ($query) use ($keyword, $allRolesColumns) {
                        foreach ($allRolesColumns as $column) {
                            $query->orWhere($column, 'LIKE', "%$keyword%");
                        }
                    });
                });
            })
            ->latest()
            ->paginate($rows);

        // $users = User::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.admin-page', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all();
        return view('admin.admin-create', compact('roles'));
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8', // Add password validation rules.
        ]);

        // Hash the password before storing it.
        $hashedPassword = Hash::make($request->password);

        // Create a new User instance and set its attributes.
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $hashedPassword, // Store the hashed password.
        ]);

        // Save the user to the database.
        $user->save();

        // Redirect to the desired page after successful user creation.
        return redirect()->route('admin-page')->with('success', 'Successfully Created !!');
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
        $roles = Roles::all();
        $user = User::find($id);
        return view('admin.admin-edit', compact('user', 'roles'));
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
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, // Allow the current user's email.
            'role' => 'required',
        ]);

        // Update the user's attributes.
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        if($request->input('password') !== null){
            $user->password = Hash::make($request->input('password')); // Hash the password.
        }

        // Save the updated user to the database.
        $user->save();

        // Redirect to the desired page after successful user update.
        return redirect()->route('admin-page')->with('success', 'Successfully Updated !!');
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

    public function status(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back();
    }

    public function searchUser(Request $request)
    {
        $users = User::with('roles')->where('name', 'LIKE', '%' . $request->keyword . '%')->get();

        return response()->json([
            'users' => $users
        ]);
    }
}