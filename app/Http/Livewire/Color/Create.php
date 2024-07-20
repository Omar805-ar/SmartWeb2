<?php

namespace App\Http\Livewire\Color;

use App\Models\Color;
use Livewire\Component;

class Create extends Component
{
    public Color $color;

    public function mount(Color $color)
    {
        $this->color = $color;
    }

    public function render()
    {
        return view('livewire.color.create');
    }

    public function submit()
    {
        $this->validate();

        $this->color->save();

        return redirect()->route('admin.colors.index');
    }

    protected function rules(): array
    {
        return [
            'color.hex' => [
                'string',
                'required',
            ],
        ];
    }
}
