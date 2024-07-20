<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Livewire\Component;

class Edit extends Component
{
    public Ticket $ticket;

    public array $listsForFields = [];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.ticket.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->ticket->save();

        return redirect()->route('admin.tickets.index');
    }

    protected function rules(): array
    {
        return [
            'ticket.merchant_id' => [
                'integer',
                'exists:merchants,id',
                'required',
            ],
            'ticket.category_id' => [
                'integer',
                'exists:ticket_categories,id',
                'required',
            ],
            'ticket.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'ticket.message' => [
                'string',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['merchant'] = Merchant::pluck('first_name', 'id')->toArray();
        $this->listsForFields['category'] = TicketCategory::pluck('icon', 'id')->toArray();
        $this->listsForFields['status']   = $this->ticket::STATUS_SELECT;
    }
}
