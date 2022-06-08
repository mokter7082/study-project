<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use App\Booking; 
use App\User; 
use App\Course; 
use Carbon\Carbon;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','store']]);
         $this->middleware('permission:admin-create', ['only' => ['create','store']]);
         $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $day = Carbon::now();
        $firstDay = $day->firstOfMonth()->format('Y-m-d');
        $lastDay = $day->lastOfMonth()->format('Y-m-d'); 

        $monthBooking = Booking::where('day_from', '>=', $firstDay)->where('day_from', '<=', $lastDay)->get(); 
 
        $dta['monthly_booking'] = $monthBooking->count(); 
        $dta['title'] = "Dashboard";

        $dta['total_booking'] = Booking::where('status', 'Complete')->get()->count(); 
        $dta['total_students'] = User::where('status', 'Active')->get()->count();
        $dta['total_course'] = Course::where('status', 'Active')->get()->count();
        $dta['total_revenue'] = Booking::where('status', 'Complete')->get()->sum('price');
 

        return view('backend.dashboard',$dta);
    }
 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Admin::orderBy('id','DESC')->paginate(5);
        return view('backend.admins.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.admins.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
 
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName);
            $input['image']=$imageName;
        }

        $admin = Admin::create($input);
        //$admin->syncRoles([$request->input('roles'), 'admin']);

        $admin->assignRole($request->input('roles')); 

        return redirect()->route('admin.index')->with('success','Admin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
       // $admin = Admin::find($id);
        return view('backend.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //$admin = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();
        return view('backend.admins.edit', compact('admin','roles','adminRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        

        $id = $admin->id;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = $request->except(['password']);
        }
        
        if($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            ]); 
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $imageName);
            $input['image']=$imageName;
        }

        $admin->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $admin->assignRole($request->input('roles')); 

        return redirect()->route('admin.index')->with('success','Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();

        return redirect()->route('admin.index')
            ->with('success','Admin deleted successfully');
    }
}
