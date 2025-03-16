<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadStatus;
use Illuminate\Http\Request;

class AdminLeadsStatusController extends Controller
{
    public function index()
    {
        $lead_status = LeadStatus::get();
        return view('admin.leads.index', compact('lead_status'));
    }



    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:leads'],

        ]);

        $lead_status = new LeadStatus();
        $lead_status->name = $request->name;
        $lead_status->save();

        return redirect()->route('admin_lead_status_index')->with('success', 'Lead Status is Created successfuly');

    }

    public function edit($id)
    {
        $lead_status = LeadStatus::find($id);
        return view('admin.leads.edit', compact('lead_status'));
    }

    public function edit_submit(Request $request, $id)
    {

        $lead_status = LeadStatus::where('id', $id)->first();
        $request->validate([
            'name' => ['required'],
        ]);

        $lead_status->name = $request->name;
        $lead_status->save();

        return redirect()->route('admin_lead_status_index')->with('success', 'Lead Status is Updated successfuly');
    }

    public function delete($id)
    {


        $lead_status = LeadStatus::find($id);
        $lead_status->delete();
        return redirect()->route('admin_lead_status_index')->with('success', 'Lead Status is Deleted successfuly');
    }
}
