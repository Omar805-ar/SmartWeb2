<?php

namespace App\Http\Livewire\TicketCategory;

use App\Models\TicketCategory;
use Livewire\Component;

class Edit extends Component
{
    public TicketCategory $ticketCategory;

    public function mount(TicketCategory $ticketCategory)
    {
        $this->ticketCategory = $ticketCategory;
    }

    public function render()
    {
        return view('livewire.ticket-category.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->ticketCategory->save();

        return redirect()->route('admin.ticket-categories.index');
    }

    protected function rules(): array
    {
        return [
            'ticketCategory.icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
