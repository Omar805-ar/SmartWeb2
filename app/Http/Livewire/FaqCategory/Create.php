<?php

namespace App\Http\Livewire\FaqCategory;

use App\Models\FaqCategory;
use Livewire\Component;

class Create extends Component
{
    public FaqCategory $faqCategory;

    public function mount(FaqCategory $faqCategory)
    {
        $this->faqCategory = $faqCategory;
    }

    public function render()
    {
        return view('livewire.faq-category.create');
    }

    public function submit()
    {
        $this->validate();

        $country_data = $this->processData();
       // dd($country_data);
        FaqCategory::create($country_data);

        
        return redirect()->route('admin.faq-categories.index');
    }

    protected function rules(): array
    {
        return [
            'faqCategory.category_ar' => [
                'string',
                'required',
            ],
            'faqCategory.category_en' => [
                'string',
                'required',
            ],
        ];
    }
    public function processData() : array {
        return [
            'ar' => [
                'category'          => $this->faqCategory->category_ar,
            ],
            'en' => [
                'category'          => $this->faqCategory->category_en,
            ],
            
         ];
    }
}
