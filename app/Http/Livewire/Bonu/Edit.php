<?php

namespace App\Http\Livewire\Bonu;

use App\Models\Bonu;
use App\Models\Country;
use Livewire\Component;

class Edit extends Component
{
    public Bonu $bonu;

    public array $listsForFields = [];

    public function mount(Bonu $bonu)
    {
        $this->bonu = $bonu;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.bonu.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->bonu->save();

        return redirect()->route('admin.bonus.index');
    }

    protected function rules(): array
    {
        return [
            'bonu.min_orders' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'bonu.minimum_order_amount' => [
                'numeric',
                'required',
            ],
            'bonu.bonus' => [
                'numeric',
                'required',
            ],
            'bonu.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['country'] = Country::pluck('currency_code', 'id')->toArray();
    }
}
