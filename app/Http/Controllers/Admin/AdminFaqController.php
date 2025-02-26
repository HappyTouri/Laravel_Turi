<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'question_en' => ['required'],
            'answer_en' => ['required'],
            'question_ru' => ['required'],
            'answer_ru' => ['required'],
            'question_ar' => ['required'],
            'answer_ar' => ['required'],
        ]);

        $faq = new Faq();
        $faq->question_en = $request->question_en;
        $faq->answer_en = $request->answer_en;
        $faq->question_ru = $request->question_ru;
        $faq->answer_ru = $request->answer_ru;
        $faq->question_ar = $request->question_ar;
        $faq->answer_ar = $request->answer_ar;
        $faq->save();

        return redirect()->route('admin_faq_index')->with('success', 'Faq is Created successfuly');

    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function edit_submit(Request $request, $id)
    {

        $faq = Faq::where('id', $id)->first();
        $request->validate([
            'question_en' => ['required'],
            'answer_en' => ['required'],
            'question_ru' => ['required'],
            'answer_ru' => ['required'],
            'question_ar' => ['required'],
            'answer_ar' => ['required'],
        ]);

        $faq->question_en = $request->question_en;
        $faq->answer_en = $request->answer_en;
        $faq->question_ru = $request->question_ru;
        $faq->answer_ru = $request->answer_ru;
        $faq->question_ar = $request->question_ar;
        $faq->answer_ar = $request->answer_ar;
        $faq->save();


        return redirect()->route('admin_faq_index')->with('success', 'faq is Updated successfuly');
    }

    public function delete($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->route('admin_faq_index')->with('success', 'faq is Deleted successfuly');
    }

}
