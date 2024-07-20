<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public Supplier $supplier;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function render()
    {
        return view('livewire.supplier.edit');
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
                'unique:suppliers,email,' . $this->supplier->id,
            ],
            'supplier.phone' => [
                'string',
                'min:10',
                'max:25',
                'required',
                'unique:suppliers,phone,' . $this->supplier->id,
            ],
        ];
    }
}
