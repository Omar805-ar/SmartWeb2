<?php

namespace App\Http\Livewire\Penalty;

use App\Models\Country;
use App\Models\Merchant;
use App\Models\Penalty;
use Livewire\Component;

class Edit extends Component
{
    public Penalty $penalty;

    public array $listsForFields = [];

    public function mount(Penalty $penalty)
    {
        $this->penalty = $penalty;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.penalty.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->penalty->save();

        return redirect()->route('admin.penalties.index');
    }

    protected function rules(): array
    {
        return [
            'penalty.merchant_id' => [
                'integer',
                'exists:merchants,id',
                'required',
            ],
            'penalty.reason' => [
                'string',
                'max:255',
                'nullable',
            ],
            'penalty.amount' => [
                'numeric',
                'required',
            ],
            'penalty.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['merchant'] = Merchant::pluck('email', 'id')->toArray();
        $this->listsForFields['country']  = Country::pluck('currency_code', 'id')->toArray();
    }
}
