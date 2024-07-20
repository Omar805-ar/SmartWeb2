<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Livewire\Component;

class Create extends Component
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
        return view('livewire.ticket.create');
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
            'ticket.type' => [
                'in:' . implode(',', array_keys($this->listsForFields['type'])),
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $categories =[];
        foreach (TicketCategory::get() as $category) {
            $categories[$category->id] = $category->translate(app()->getLocale())->name;
        }
      

        $this->listsForFields['merchant'] = Merchant::pluck('email', 'id')->toArray();
        $this->listsForFields['category'] = $categories;
        $this->listsForFields['status']   = $this->ticket::STATUS_SELECT;
        $this->listsForFields['type']   = $this->ticket::TYPE_SELECT;
    }
}
