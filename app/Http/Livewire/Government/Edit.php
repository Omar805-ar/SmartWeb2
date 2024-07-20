<?php

namespace App\Http\Livewire\Government;

use App\Models\Country;
use App\Models\Government;
use Livewire\Component;

class Edit extends Component
{
    public Government $government;

    public array $listsForFields = [];

    public function mount(Government $government)
    {
        $this->government = $government;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.government.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->government->save();

        return redirect()->route('admin.governments.index');
    }

    protected function rules(): array
    {
        return [
            'government.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['country'] = Country::pluck('iso', 'id')->toArray();
    }
}
