<?php

namespace App\Http\Livewire\Government;

use App\Models\Country;
use App\Models\Government;
use Livewire\Component;

class Create extends Component
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
        return view('livewire.government.create');
    }

    public function submit()
    {
        $this->validate();

        $government_data = $this->processData();

        Government::create($government_data);
        
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
            'government.name_en' => [
                'string',
                'max:255',
                'required',
            ],
            'government.name_ar' => [
                'string',
                'max:255',
                'required',
            ],
           
            'government.shipping_cost' => [
                'numeric',
                'required',
            ]
        ];
    }
    public function processData() : array {
        return [
            'ar' => [
                'name'          => $this->government->name_ar,
            ],
            'en' => [
                'name'          => $this->government->name_en,
            ],
            'country_id'        =>  $this->government->country_id,
            'shipping_cost'     =>  $this->government->shipping_cost,
            
         ];
    }
    protected function initListsForFields(): void
    {
        $this->listsForFields['country'] = Country::pluck('iso', 'id')->toArray();
    }
}
