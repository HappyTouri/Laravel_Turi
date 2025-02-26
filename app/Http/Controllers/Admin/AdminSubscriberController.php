<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Subscriber;
use Illuminate\Http\Request;


class AdminSubscriberController extends Controller
{
    public function subscribers()
    {
        $subscribers = Subscriber::where('status', 'Active')->get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function send_email()
    {
        return view('admin.subscriber.send_email');
    }

    public function send_email_submit(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required']
        ]);


        $subject = $request->subject;
        $message = $request->message;

        $subscribers = Subscriber::where('status', 'Active')->get();

        foreach ($subscribers as $key => $subscriber) {
            \Mail::to($subscriber->email)->send(new Websitemail($subject, $message));
        }

        return redirect()->back()->with('success', 'Emails Send Successfully');

    }


    public function delete($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        return redirect()->back()->with('success', 'Subscriber is Deleted successfuly');
    }
}
