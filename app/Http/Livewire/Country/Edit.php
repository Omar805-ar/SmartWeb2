<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;

class Edit extends Component
{
    public Country $country;

    public function mount(Country $country)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.country.edit');
    }

    public function submit()
    {
        $this->validate();
        $country_data = $this->processData();
        $this->country->save();

        return redirect()->route('admin.countries.index');
    }
    
    protected function rules(): array
    {
        return [
            'country.iso' => [
                'string',
                'min:4',
                'max:5',
                'required',
                'unique:countries,iso,' . $this->country->id,
            ],
            'country.currency_code' => [
                'string',
                'min:4',
                'max:5',
                'required',
                'unique:countries,currency_code,' . $this->country->id,
            ],
            'country.name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'country.name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
        ];
    }
}
