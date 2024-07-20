<?php

namespace App\Http\Livewire\FaqQuestion;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Livewire\Component;

class Create extends Component
{
    public FaqQuestion $faqQuestion;

    public array $listsForFields = [];

    public function mount(FaqQuestion $faqQuestion)
    {
        $this->faqQuestion = $faqQuestion;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.faq-question.create');
    }

    public function submit()
    {
        $this->validate();

        FaqQuestion::create($this->processData());

        return redirect()->route('admin.faq-questions.index');
    }

    protected function rules(): array
    {
        return [
            'faqQuestion.category_id' => [
                'integer',
                'exists:faq_categories,id',
                'required',
            ],
            'faqQuestion.question_ar' => [
                'string',
                'required',
            ],
            'faqQuestion.question_en' => [
                'string',
                'required',
            ],
            'faqQuestion.answer_ar' => [
                'string',
                'required',
            ],
            'faqQuestion.answer_en' => [
                'string',
                'required',
            ],
        ];
    }
    public function processData() : array {
        return [
            'ar' => [
                'question'          => $this->faqQuestion->question_ar,
                'answer'          => $this->faqQuestion->answer_ar,
            ],
            'en' => [
                'question'          => $this->faqQuestion->question_en,
                'answer'          => $this->faqQuestion->answer_en,

            ],
            'category_id'          => $this->faqQuestion->category_id,

         ];
    }
    protected function initListsForFields(): void
    {
        $categories = [];
        foreach (FaqCategory::get() as $category) {
            $categories[$category->id] = $category->translate(app()->getLocale())->category;
        }        
        $this->listsForFields['category'] = $categories;
    }
}
