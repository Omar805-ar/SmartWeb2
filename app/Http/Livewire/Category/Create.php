<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.category.create');
    }

    public function submit()
    {
        $this->validate();
        
        $category_data = $this->processData();

        Category::create($category_data);

        return redirect()->route('admin.categories.index');
    }
    public function processData() : array {
        return [
            'ar' => [
                'name'                      => $this->category->name_ar,
                'meta_description'          => $this->category->meta_description_ar,
            ],
            'en' => [
                'name'              => $this->category->name_en,
                'meta_description'  => $this->category->meta_description_en,
            ],
            'slug'               => str_replace(' ', '-', $this->category->name_ar) . '-' . str_replace(' ', '-', $this->category->name_en).'-category',
            'icon'               =>  $this->category->icon,
         ];
    }
    protected function rules(): array
    {
        return [
           
            'category.name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'category.name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'category.meta_description_en' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'category.meta_description_ar' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'category.icon' => [
                'string',
                'required',
            ],
        ];
    }
}
