<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered ;

// AdminController handles administrative actions such as managing admin users.
class AdminController extends Controller
{
    // Displays a list of admin users.
    public function index(){
        // Fetch roles for superadmin and admin.
        $superAdminRole = Role::where('name','superadmin')->first();
        $adminRole=Role::where('name','admin')->first();
        // Retrieve and paginate admin users.
        $data['admins'] = User::whereIn('role_id',[$superAdminRole->id,$adminRole->id])
        ->orderBy('id','DESC')->paginate(10);
        // Return the admin index view with the retrieved data.
        return view('admin.admins.index')->with($data) ;
    }

    // Shows the form for creating a new admin user.
    public function create(){
        // Fetch roles eligible for admin users.
        $data['roles'] = Role::select('id','name')->whereIn('name',['superadmin','admin'])->get();
        // Return the admin creation view with the roles data.
        return view('admin.admins.create')->with($data);
    }

    // Stores a new admin user in the database.
    public function store(Request $request){
        // Validate the incoming request data.
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|string|max:25|confirmed',
            'role_id'=>'required|exists:roles,id',
        ]);
        // Create the user with the validated data.
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id,
        ]);
        // Fire an event upon successful registration.
        event(new Registered($user));
        // Redirect to the admin list view.
        return redirect(url('dashboard/admins'));
    }

    // Promotes a user to superadmin.
    public function promote($id){
        // Find the user by ID and fail if not found.
        $admin = User::findOrFail($id);
        // Update the user's role to superadmin.
        $admin->update([
            'role_id'=>Role::select('id')->where('name','superadmin')->first()->id,
        ]);
        // Return back to the previous page.
        return back();
    }

    // Demotes a superadmin to admin.
    public function demote($id){
        // Find the user by ID and fail if not found.
        $superAdmin = User::findOrFail($id);
        // Update the user's role to admin.
        $superAdmin->update([
            'role_id'=>Role::select('id')->where('name','admin')->first()->id,
        ]);
        // Return back to the previous page.
        return back();
    }
}
