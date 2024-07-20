<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqQuestionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('faq_question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faq-question.index');
    }

    public function create()
    {
        abort_if(Gate::denies('faq_question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faq-question.create');
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = [];
        $listsForFields = [];
        foreach (FaqCategory::get() as $category) {
            $categories[$category->id] = $category->translate(app()->getLocale())->category;
        }        
        $listsForFields['category'] = $categories;
        return view('admin.faq-question.edit', compact('faqQuestion', 'listsForFields'));
    }

    public function show(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->load('category');

        return view('admin.faq-question.show', compact('faqQuestion'));
    }
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        FaqQuestion::findOrFail($id)->update($this->processData($request));

        return redirect()->route('admin.faq-questions.index');

    }



    public function processData($request) : array {
        return [
            'ar' => [
                'question'                  => $request->question_ar,
                'answer'                    => $request->answer_ar
            ],
            'en' => [
                'question'                  => $request->question_en,
                'answer'                    => $request->answer_en
            ],

         ];
    }
}
