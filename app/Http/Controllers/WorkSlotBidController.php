<?php

namespace App\Http\Controllers;

use App\Models\StaffRoles;
use App\Models\WorkSlot;
use App\Models\WorkSlotBid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\StaffRoleBid;

class WorkSlotBidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:workslotbid-list|workslotbid-create|workslotbid-edit|workslotbid-delete', ['only' => ['index']]);
        $this->middleware('permission:workslotbid-create', ['only' => ['create','store']]);
        $this->middleware('permission:workslotbid-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:workslotbid-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if(auth()->user()->role_id == 3){
            $workslotbids = WorkSlotBid::paginate(200);
            $workslots = WorkSlot::paginate(200);
            $users = User::paginate(200);
            return view('workslotbids.index', [
                'workslotbids' => $workslotbids,
                'workslots' => $workslots,
                'users' => $users
            ]);
            
        } elseif(auth()->user()->role_id == 4) {
            $workslotbids = WorkSlotBid::where('user_id', auth()->user()->id)->paginate(200);
            $workslots = WorkSlot::paginate(200);
            $users = User::query()->where('id', auth()->user()->id)->paginate(200);
            return view('workslotbids.index', [
                'workslotbids' => $workslotbids,
                'workslots' => $workslots,
                'users' => $users
            ]);
        }
    }

    public function create()
    {
        $workslots = WorkSlot::query()
                            ->where('staff_role_id', auth()->user()->staff_role_id)
                            ->whereNull('deleted_at')
                            ->paginate(200);
        $workslotbids = WorkSlotBid::query()
                            ->where('user_id', auth()->user()->id)
                            ->whereNull('deleted_at')
                            ->paginate(200);
        return view('workslotbids.create', [
            'workslots' => $workslots,
            'workslotbids' => $workslotbids,

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'work_slot_id' => 'required',
        'user_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            // Store Data
            $bid = WorkSlotBid::create([
                'work_slot_id' => $request->work_slot_id,
                'user_id' => $request->user_id,
                'status' => '0',
                'created_at' => now()
            ]);
            // Commit And Redirected To Listing
            DB::commit();
                
            //dd($request);
            return redirect()->route('workslotbids.create')->with('success','Bid Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->route('workslotbids.create')->with('error',$th->getMessage());
        }
    }
    public function offer()
    {
        $workslots = WorkSlot::query()
                            ->whereNull('deleted_at')
                            ->paginate(200);
        $workslotbids = WorkSlotBid::query()
                            ->whereNull('deleted_at')
                            ->paginate(200);
        $users = User::query()
                    ->whereNotNull('staff_role_id')
                ->paginate(200);
        $staffroles = StaffRoles::query()
                            ->paginate(200);
        return view('workslotbids.offer', [
            'workslots' => $workslots,
            'workslotbids' => $workslotbids,
            'users' =>$users,
            'staffroles' => $staffroles

        ]);
    }

    public function offerstore(Request $request){

        $request->validate([
            'work_slot_id' => 'required',
            'user_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            // Store Data
            $bid = WorkSlotBid::create([
                'work_slot_id' => $request->work_slot_id,
                'user_id' => $request->user_id,
                'status' => '2',
                'created_at' => now()
            ]);
            // Commit And Redirected To Listing
            DB::commit();
                
            //dd($request);
            return redirect()->route('workslotbids.offer')->with('success','Bid Offered Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->route('workslotbids.offer')->with('error',$th->getMessage());
        }


    }


    public function update(Request $request, WorkSlotBid $workSlotBid)
    {
        // Validate Request
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();     
        try {
            
            $workSlotBid->update([
                'status' => $request->status,
                'remarks' =>$request->remarks,
            ]);
            DB::commit();

            return redirect()->route('workslotbids.index')->with('success','Work Slot Bid updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('workslotbids.index',['workSlotBid' => $workSlotBid])->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
    
            WorkSlotBid::where(['id' => $id])->delete();
            
            DB::commit();
            return redirect()->route('workslotbids.index')->with('success','Workslot deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('workslotbids.index')->with('error',$th->getMessage());
        }
    }
}