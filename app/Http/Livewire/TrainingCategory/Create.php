<?php

namespace App\Http\Livewire\TrainingCategory;

use App\Models\TrainingCategory;
use Livewire\Component;

class Create extends Component
{
    public TrainingCategory $trainingCategory;

    public function mount(TrainingCategory $trainingCategory)
    {
        $this->trainingCategory = $trainingCategory;
    }

    public function render()
    {
        return view('livewire.training-category.create');
    }

    public function submit()
    {
        $this->validate();

        $TrainingCategory = $this->processData();

        TrainingCategory::create($TrainingCategory);


        
        return redirect()->route('admin.training-categories.index');
    }

    protected function rules(): array
    {
        return [
            'trainingCategory.name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'trainingCategory.name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'trainingCategory.meta_description_en' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'trainingCategory.meta_description_ar' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
        ];
    }
    public function processData() : array {
        return [
            'ar' => [
                'name'                      => $this->trainingCategory->name_ar,
                'meta_description'          => $this->trainingCategory->meta_description_ar,
            ],
            'en' => [
                'name'                      => $this->trainingCategory->name_en,
                'meta_description'          => $this->trainingCategory->meta_description_en,
            ],
            'slug'                          => str_replace(' ', '-', $this->trainingCategory->name_ar) . '-' . str_replace(' ', '-', $this->trainingCategory->name_en).'-trainingCategory',

         ];
    }
    
}
