<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Create extends Component
{
    public Setting $setting;

    public function mount(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function render()
    {
        return view('livewire.setting.create');
    }

    public function submit()
    {
        $this->validate();

        $this->setting->save();

        return redirect()->route('admin.settings.index');
    }

    protected function rules(): array
    {
        return [
        ];
    }
}
