<?php

namespace App\Http\Livewire\Order;

use App\Models\Country;
use App\Models\Merchant;
use App\Models\Order;
use Livewire\Component;

class Edit extends Component
{
    public Order $order;

    public array $listsForFields = [];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.order.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->order->save();

        return redirect()->route('admin.orders.index');
    }

    protected function rules(): array
    {
        return [
            'order.admin_subtotal' => [
                'numeric',
                'required',
            ],
            'order.merchant_subtotal' => [
                'numeric',
                'required',
            ],
            'order.shipping_cost' => [
                'numeric',
                'required',
            ],
            'order.admin_grand_total' => [
                'numeric',
                'required',
            ],
            'order.merchant_grand_total' => [
                'string',
                'required',
            ],
            'order.admin_net_profit' => [
                'numeric',
                'required',
            ],
            'order.merchant_net_profit' => [
                'numeric',
                'required',
            ],
            'order.merchant_id' => [
                'integer',
                'exists:merchants,id',
                'required',
            ],
            'order.country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'order.city' => [
                'string',
                'max:255',
                'required',
            ],
            'order.address' => [
                'string',
                'max:255',
                'required',
            ],
            'order.address_2' => [
                'string',
                'max:255',
                'nullable',
            ],
            'order.notes' => [
                'string',
                'max:255',
                'nullable',
            ],
            'order.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['merchant'] = Merchant::pluck('email', 'id')->toArray();
        $this->listsForFields['country']  = Country::pluck('iso', 'id')->toArray();
        $this->listsForFields['status']   = $this->order::STATUS_SELECT;
    }
}
