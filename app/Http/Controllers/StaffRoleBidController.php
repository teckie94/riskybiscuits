<?php

namespace App\Http\Controllers;
use App\Models\StaffRoles;
use App\Models\StaffRoleBid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaffRoleBidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:staffrolebid-list|staffrolebid-create|staffrolebid-edit|staffrolebid-delete', ['only' => ['index']]);
        $this->middleware('permission:staffrolebid-create', ['only' => ['create','store']]);
        $this->middleware('permission:staffrolebid-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staffrolebid-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if(auth()->user()->role_id == 3) {
            $staffrolebids = StaffRoleBid::paginate(200);
            $staffroles = StaffRoles::paginate(200);
            $users = User::paginate(200);

        } else if(auth()->user()->role_id == 4 ) {
            $staffrolebids = StaffRoleBid::where('user_id', auth()->user()->id)->paginate(10);
            $staffroles = StaffRoles::paginate(10);
            $users = User::query()->where('id', auth()->user()->id)->paginate(10);

        }
        return view('staffrolebids.index')->with([
            'staffrolebids' => $staffrolebids,
            'staffroles' => $staffroles,
            'users' => $users
        ]);
    }

    public function create()
    {
        
        $staffroles = StaffRoles::query()
                            ->whereNull('deleted_at')
                            ->paginate(10);
        $staffrolebids = StaffRoleBid::query()
                            ->where('user_id', auth()->user()->id)
                            ->whereNull('deleted_at')
                            ->paginate(10);

        return view('staffrolebids.create', [
            'staffroles' => $staffroles,
            'staffrolebids' => $staffrolebids,

        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
        'staff_role_id' => 'required',
        'user_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            // Store Data
            $bid = StaffRoleBid::create([
                'staff_role_id' => $request->staff_role_id,
                'user_id' => $request->user_id,
                'status' => '0',
                'created_at' => now()
            ]);
            // Commit And Redirected To Listing
            DB::commit();
                
            //dd($request);
            return redirect()->route('staffrolebids.create')->with('success','Bid Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->route('staffrolebids.create')->with('error',$th->getMessage());
        }
    }

    public function update(Request $request, StaffRoleBid $staffRoleBid)
    {
        // Validate Request
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            
            $staffRoleBid->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            if($request->status == 1){
                $user = User::whereId($request->user_id)->first();
                $user->update ([
                    'staff_role_id'=> $request->staff_role_id,    
                ]);
            }
            
            DB::commit();
            return redirect()->route('staffrolebids.index')->with('success','Staff Role Bids updated successfully.');
        
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebids.index',['staffRoleBid' => $staffRoleBid])->with('error',$th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            StaffRoleBid::where(['id' => $id])->delete();

            DB::commit();
            return redirect()->route('staffrolebids.index')->with('success','Staff role bids deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebids.index')->with('error',$th->getMessage());
        }
    }
            

}