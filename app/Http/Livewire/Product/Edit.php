<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    public Product $product;

    public array $listsForFields = [];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->product->save();

        return redirect()->route('admin.products.index');
    }

    protected function rules(): array
    {
        return [
            'product.category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
            'product.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'product.price' => [
                'numeric',
                'required',
            ],
            'product.slug' => [
                'string',
                'max:255',
                'required',
                'unique:products,slug,' . $this->product->id,
            ],
            'product.product_code' => [
                'string',
                'max:255',
                'required',
                'unique:products,product_code,' . $this->product->id,
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['category'] = Category::pluck('slug', 'id')->toArray();
        $this->listsForFields['country']  = Country::pluck('iso', 'id')->toArray();
    }
}
