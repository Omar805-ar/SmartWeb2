<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public Country $country;
    public $iso;

    public function mount(Country $country)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.country.create');
    }

    public function submit()
    {
        $this->validate();
        
        $country_data = $this->processData();

         Country::create($country_data);


        return redirect()->route('admin.countries.index');
    }


    public function processData() : array {
        return [
            'ar' => [
                'name'          => $this->country->name_ar,
            ],
            'en' => [
                'name'          => $this->country->name_en,
            ],
            'iso'               =>  $this->country->iso,
            'currency_code'     => $this->country->currency_code,
            'flag'              => '<span class="fi fi-'.strtolower(Str::limit($this->country->iso, 2, '')).'"></span>',
         ];
    }

    protected function rules(): array
    {
        return [
            'country.iso' => [
                'string',
                'min:3',
                'max:3',
                'required',
                'unique:countries,iso',
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
            'country.currency_code' => [
                'string',
                'min:2',
                'max:5',
                'required',
                'unique:countries,currency_code',

            
            ],
        ];
    }
}
