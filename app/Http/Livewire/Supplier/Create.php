<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public Supplier $supplier;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function render()
    {
        return view('livewire.supplier.create');
    }

    public function submit()
    {
        $this->validate();

        $this->supplier->save();

        return redirect()->route('admin.suppliers.index');
    }

    protected function rules(): array
    {
        return [
            'supplier.name' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
            'supplier.email' => [
                'string',
                'max:255',
                'required',
                'unique:suppliers,email',
            ],
            'supplier.phone' => [
                'string',
                'min:10',
                'max:25',
                'required',
                'unique:suppliers,phone',
            ],
        ];
    }
}
