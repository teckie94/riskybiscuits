<?php

namespace App\Http\Controllers;

use App\Models\StaffRoleBid;
use App\Models\WorkSlotBid;
use App\Models\WorkSlot;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function index(Request $request)
     {
         $staffCount = User::where('role_id', 4)->count();
     
         $pendingStaffRoleApprovalCount = StaffRoleBid::whereHas('user', function ($query) {
             $query->where('role_id', 4);
         })->where('status', 0)->count();

         $pendingWorkslotApprovalCount = WorkSlotBid::whereHas('user', function ($query) {
            $query->where('role_id', 4);
        })->where('status', 0)->count();

         // Retrieve the count of work slots that do not have a corresponding entry in the WorkSlotBid table
        $availableWorkslotsCount = WorkSlot::whereNotIn('id', WorkSlotBid::where('status', 1)->pluck('work_slot_id'))->count();

        // Retrieve dynamic data, for example from your database
        $revenueData = [$staffCount, $pendingStaffRoleApprovalCount, $availableWorkslotsCount];
     
         return view('home', compact('staffCount', 'pendingStaffRoleApprovalCount',
         'pendingWorkslotApprovalCount', 'availableWorkslotsCount', 'revenueData'));
     }
     

    public function getProfile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        #Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'mobile_number' => 'required|numeric|digits:8',
        ]);

        try {
            DB::beginTransaction();
            
            #Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Profile Updated Successfully.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

   
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            
            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Password Changed Successfully.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
