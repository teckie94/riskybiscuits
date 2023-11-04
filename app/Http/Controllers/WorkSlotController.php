<?php

namespace App\Http\Controllers;

use App\Models\WorkSlot;
use App\Models\StaffRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkSlotController extends Controller
{
    public function index()
    {
        $workSlots = WorkSlot::all();
        return view('workslot.index', compact('workSlots'));
    }

    public function create()
    {
        $staffRoles = StaffRoles::all(); // Fetch cafe roles from the database
        return view('workslot.create', compact('staffRoles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'staff_role_id'             => 'required',
            /* 'time_slot_name'         => 'required', */
            'start_date'                => 'required',
            'end_date'                  => 'required',
            'start_time'                => 'required',
            'end_time'                  => 'required',
            'quantity'                  => 'required',
        ]);

        DB::beginTransaction();

        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);

        try {

            // Store Data
            while ($startDate <= $endDate) {
                WorkSlot::create([
                    'staff_role_id'     => $request->staff_role_id,
                    'start_date'        => $startDate->format('Y-m-d'),
                    'end_date'          => $request->end_date,
                    'start_time'        => $request->start_time,
                    'end_time'          => $request->end_time,
                    'quantity'          => $request->quantity,
                ]);
        
                $startDate->add(new \DateInterval('P1D')); // Increment date by 1 day
            }

            
            // Commit And Redirected To Listing
            DB::commit();

            
            return redirect()->route('workslot.index')->with('success','Workslot Created Successfully.');


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

   /*  public function edit(WorkSlot $workSlot) {
        
        return view('workslot.edit', compact('workSlot'));
    } */

    public function edit(WorkSlot $workSlot) {
        $staffRoles = StaffRoles::all(); // Fetch cafe roles from the database
        return view('workslot.edit', compact('workSlot', 'staffRoles'));
    }
    


    public function update(Request $request, WorkSlot $workSlot)
        {
             $request->validate([
                'staff_role_id'             => 'required',
                /* 'time_slot_name'         => 'required', */
                'start_date'                => 'required',
                /* 'end_date'                  => 'required', */
                'start_time'                => 'required',
                'end_time'                  => 'required',
                'quantity'                  => 'required',
        ]);

            DB::beginTransaction();

            try {
                // Update Data
                $workSlot->update([
                    'staff_role_id'         => $request->staff_role_id,
                    /* 'time_slot_name'     => $request->time_slot_name, */
                    'start_date'            => $request->start_date,
                    /* 'end_date'              => $request->end_date, */
                    'start_time'            => $request->start_time,
                    'end_time'              => $request->end_time,
                    'quantity'              => $request->quantity,
                ]);

                // Commit And Redirected To Listing
                DB::commit();
                
                
                return redirect()->route('workslot.index')->with('success', 'Workslot Updated Successfully.');
            } catch (\Throwable $th) {

                // Rollback and return with Error
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', $th->getMessage());
            }
        }


    public function destroy(WorkSlot $workSlot)
    {
        $workSlot->delete();
        return redirect()->route('workslots.index');
    }
}

