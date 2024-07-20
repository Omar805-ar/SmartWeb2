<?php

namespace App\Http\Livewire\TicketCategory;

use App\Models\TicketCategory;
use Livewire\Component;

class Create extends Component
{
    public TicketCategory $ticketCategory;

    public function mount(TicketCategory $ticketCategory)
    {
        $this->ticketCategory = $ticketCategory;
    }

    public function render()
    {
        return view('livewire.ticket-category.create');
    }

    public function submit()
    {
        $this->validate();

        $government_data = $this->processData();

        TicketCategory::create($government_data);
        
        return redirect()->route('admin.ticket-categories.index');
    }

    protected function rules(): array
    {
        return [
            'ticketCategory.name_ar' => [
                'string',
                'required',
                'max:255',
                'min:2'
            ],
            'ticketCategory.name_en' => [
                'string',
                'required',
                'max:255',
                'min:2'
            ],
        ];
    }
    public function processData() : array {
        return [
            'ar' => [
                'name'          => $this->ticketCategory->name_ar,
            ],
            'en' => [
                'name'          => $this->ticketCategory->name_en,
            ],            
         ];
    }
}
