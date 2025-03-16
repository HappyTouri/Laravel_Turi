<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Cooperator;
use App\Models\Lead;
use App\Models\LeadStatus;
use Exception;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function get_all_lead_status()
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Define the base query
            $lead_status = LeadStatus::get();

            // Return success response with retrieved tours
            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $lead_status,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function get_all_cooperators()
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Define the query based on role
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $cooperators = Cooperator::whereIn('rule_id', [1, 5, 7])->get();
                    break;

                case 5: // Travel Agency
                case 7: // Customer Service
                    $cooperators = Cooperator::where('id', $cooperator->id)->get();
                    break;

                default:
                    return ResponseHelper::Error(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Return success response with retrieved cooperators
            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $cooperators,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }



    // Leads
    ////////////////////////////////////
    public function get_all_leads()
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Define the base query
            $query = Lead::where('archived', false)
                ->orWhereNull('archived')
                ->with('status', 'cooperator', 'privateTour');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $leads = $query->get();
                    break;


                case 5: // Travel Agency
                    $leads = $query->where('cooperator_id', $cooperator->id)->get();
                    break;

                case 7: // Customer Service
                    $leads = $query->where('cooperator_id', $cooperator->id)->get();
                    break;

                default:
                    return ResponseHelper::Error(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Return success response with retrieved tours
            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $leads,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function get_all_leads_archive()
    {
        try {
            $cooperator = auth()->user();

            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Error(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Define the base query
            $query = Lead::where('archived', true)
                ->with('status', 'cooperator', 'privateTour');

            //1-Admin  2-Tour Operator   3-Tourguide   4-Hotel   5-Travel Agency  6-Driver 7-Customer Service
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    $leads = $query->get();
                    break;


                case 5: // Travel Agency
                    $leads = $query->where('cooperator_id', $cooperator->id)->get();
                    break;

                case 7: // Customer Service
                    $leads = $query->where('cooperator_id', $cooperator->id)->get();
                    break;

                default:
                    return ResponseHelper::Error(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Return success response with retrieved tours
            return ResponseHelper::Success(
                message: 'Loaded Successfully',
                data: $leads,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }


    public function create_lead(Request $request)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Check user role based on rule_id
            switch ($cooperator->rule_id) {
                case 1: // Admin: Admin can create day tours
                    break;

                case 5: // Travel Agency
                    break;

                case 7: // Customer Service
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // Validate the request data
            $validated = $request->validate([
                'cooperator_id' => 'required',
                'status_id' => 'nullable|exists:lead_status,id',
                'private_tour_id' => 'nullable|integer',
                'phone_number' => ['required', 'unique:leads,phone_number'],
                'lead_name' => 'nullable|string|max:255',
                'name' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'number_of_person' => 'nullable|integer',
                'arrive_to' => 'nullable|string|max:255',
                'departure_from' => 'nullable|string|max:255',
                'from' => 'nullable|date',
                'till' => 'nullable|date',
                'number_of_days' => 'nullable',
                'airticket' => 'nullable|boolean',
                'accommodation' => 'nullable|boolean',
                'tour' => 'nullable|boolean',
                'follow_up' => 'nullable|boolean',
                'confirm' => 'nullable|boolean',
                'customer_note' => 'nullable',
            ]);

            $lead = new Lead();

            // Assign the validated data to the lead object
            $lead->cooperator_id = $validated['cooperator_id'];
            $lead->status_id = $validated['status_id'];
            $lead->private_tour_id = $validated['private_tour_id'];
            $lead->phone_number = $validated['phone_number'];
            $lead->lead_name = $validated['lead_name'];
            $lead->name = $validated['name'];
            $lead->country = $validated['country'];
            $lead->nationality = $validated['nationality'];
            $lead->number_of_person = $validated['number_of_person'];
            $lead->arrive_to = $validated['arrive_to'];
            $lead->departure_from = $validated['departure_from'];
            $lead->from = $validated['from'];
            $lead->till = $validated['till'];
            $lead->number_of_days = $validated['number_of_days'];
            $lead->airticket = $validated['airticket'];
            $lead->accommodation = $validated['accommodation'];
            $lead->tour = $validated['tour'];
            $lead->follow_up = $validated['follow_up'];
            $lead->confirm = $validated['confirm'];
            $lead->lead_note = $validated['customer_note'];

            // Save the new lead
            $lead->save();


            // Return success response with created tour data
            return ResponseHelper::Success(
                message: 'Lead Created Successfully',
                data: $lead,
                statusCode: 201
            );
        } catch (Exception $e) {
            return ResponseHelper::Success(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function edit_lead(Request $request, $id)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            // Check the user's role and restrict access based on role
            switch ($cooperator->rule_id) {
                case 1: // Admin
                    // Admin can update any day tour
                    $lead = Lead::find($id);
                    break;

                case 5: // Travel Agency
                    $lead = Lead::find($id);
                    break;

                case 7: // Customer Service
                    $lead = Lead::find($id);
                    break;

                default:
                    return ResponseHelper::Success(
                        message: 'Unauthorized',
                        statusCode: 403
                    );
            }

            // If the tour is not found
            if (!$lead) {
                return ResponseHelper::Success(
                    message: 'Lead not found or you do not have permission to update this Lead',
                    statusCode: 404
                );
            }

            // Validate the request data
            $validated = $request->validate([
                'cooperator_id' => 'required',
                'status_id' => 'nullable|exists:lead_status,id',
                'private_tour_id' => 'nullable|integer',
                'phone_number' => 'required|unique:leads,phone_number,' . $request->route('id'),
                'lead_name' => 'nullable|string|max:255',
                'name' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'number_of_person' => 'nullable|integer',
                'arrive_to' => 'nullable|string|max:255',
                'departure_from' => 'nullable|string|max:255',
                'from' => 'nullable|date',
                'till' => 'nullable|date',
                'number_of_days' => 'nullable',
                'airticket' => 'nullable|boolean',
                'accommodation' => 'nullable|boolean',
                'tour' => 'nullable|boolean',
                'follow_up' => 'nullable|boolean',
                'confirm' => 'nullable|boolean',
                'archived' => 'nullable|boolean',
                'customer_note' => 'nullable',
            ]);

            $lead->cooperator_id = $validated['cooperator_id'];
            $lead->status_id = $validated['status_id'];
            $lead->private_tour_id = $validated['private_tour_id'];
            $lead->phone_number = $validated['phone_number'];
            $lead->lead_name = $validated['lead_name'];
            $lead->name = $validated['name'];
            $lead->country = $validated['country'];
            $lead->nationality = $validated['nationality'];
            $lead->number_of_person = $validated['number_of_person'];
            $lead->arrive_to = $validated['arrive_to'];
            $lead->departure_from = $validated['departure_from'];
            $lead->from = $validated['from'];
            $lead->till = $validated['till'];
            $lead->number_of_days = $validated['number_of_days'];
            $lead->airticket = $validated['airticket'];
            $lead->accommodation = $validated['accommodation'];
            $lead->tour = $validated['tour'];
            $lead->follow_up = $validated['follow_up'];
            $lead->confirm = $validated['confirm'];
            $lead->archived = $validated['archived'];
            $lead->lead_note = $validated['customer_note'];
            $lead->save();

            return ResponseHelper::Success(
                message: 'Lead Updated Successfully',
                data: $lead,
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function delete_lead($id)
    {
        try {
            $cooperator = auth()->user();
            // Check if the user is authenticated
            if (!$cooperator) {
                return ResponseHelper::Success(
                    message: 'Unauthorized',
                    statusCode: 401
                );
            }

            $lead = Lead::find($id);


            // If the tour is not found or user doesn't have permission to delete it
            if (!$lead) {
                return ResponseHelper::Success(
                    message: 'Lead not found or you do not have permission to delete this Lead',
                    statusCode: 404
                );
            }

            // Delete the tour
            $lead->delete();

            // Return success response
            return ResponseHelper::Success(
                message: 'Lead Deleted Successfully',
                statusCode: 200
            );
        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

}
