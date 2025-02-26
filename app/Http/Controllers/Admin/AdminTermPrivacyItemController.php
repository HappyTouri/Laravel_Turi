<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermPrivacyItem;
use Illuminate\Http\Request;

class AdminTermPrivacyItemController extends Controller
{
    public function index()
    {
        $term_privacy_item = TermPrivacyItem::where('id', 1)->first();
        return view('admin.term_privacy_item.index', compact('term_privacy_item'));
    }

    public function update(Request $request)
    {

        $term_privacy_item = TermPrivacyItem::where('id', 1)->first();
        $term_privacy_item->term = $request->term;
        $term_privacy_item->privacy = $request->privacy;
        $term_privacy_item->save();

        return redirect()->back()->with('success', 'Term & Privacy Items Updated successfuly');
    }
}
