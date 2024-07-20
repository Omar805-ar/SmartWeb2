<?php

namespace App\Http\Livewire\TrainingCategory;

use App\Models\TrainingCategory;
use Livewire\Component;

class Edit extends Component
{
    public TrainingCategory $trainingCategory;

    public function mount(TrainingCategory $trainingCategory)
    {
        $this->trainingCategory = $trainingCategory;
    }

    public function render()
    {
        return view('livewire.training-category.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->trainingCategory->save();

        return redirect()->route('admin.training-categories.index');
    }

    protected function rules(): array
    {
        return [
            'trainingCategory.slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
