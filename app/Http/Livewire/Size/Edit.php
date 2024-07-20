<?php

namespace App\Http\Livewire\Size;

use App\Models\Size;
use Livewire\Component;

class Edit extends Component
{
    public Size $size;

    public function mount(Size $size)
    {
        $this->size = $size;
    }

    public function render()
    {
        return view('livewire.size.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->size->save();

        return redirect()->route('admin.sizes.index');
    }

    protected function rules(): array
    {
        return [
            'size.size' => [
                'string',
                'required',
            ],
        ];
    }
}
