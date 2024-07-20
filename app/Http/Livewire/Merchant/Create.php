<?php

namespace App\Http\Livewire\Merchant;

use App\Models\Merchant;
use Livewire\Component;

class Create extends Component
{
    public Merchant $merchant;

    public function mount(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    public function render()
    {
        return view('livewire.merchant.create');
    }

    public function submit()
    {
        $this->validate();

        $this->merchant->save();

        return redirect()->route('admin.merchants.index');
    }

    protected function rules(): array
    {
        return [
            'merchant.first_name' => [
                'string',
                'min:4',
                'max:255',
                'required',
            ],
            'merchant.last_name' => [
                'string',
                'min:4',
                'max:255',
                'required',
            ],
            'merchant.email' => [
                'email:rfc',
                'required',
                'unique:merchants,email',
            ],
            'merchant.phone' => [
                'string',
                'min:10',
                'max:25',
                'required',
                'unique:merchants,phone',
            ],
            'merchant.referral_code' => [
                'string',
                'required',
                'unique:merchants,referral_code',
            ],
        ];
    }
}
