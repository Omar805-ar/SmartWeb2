<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTicketCategoryRequest;
use App\Models\TicketCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ticket_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ticket-category.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ticket_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ticket-category.create');
    }

    public function edit(TicketCategory $ticketCategory)
    {
        abort_if(Gate::denies('ticket_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ticket-category.edit', compact('ticketCategory'));
    }

    public function update(UpdateTicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        abort_if(Gate::denies('ticket_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticketCategory->update($this->processData($request));

        return redirect()->route('admin.ticket-categories.index');
    }
    public function show(TicketCategory $ticketCategory)
    {
        abort_if(Gate::denies('ticket_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ticket-category.show', compact('ticketCategory'));
    }
    public function processData($request) : array {
        return [
            'ar' => [
                'name'                  => $request->name_ar,
            ],
            'en' => [
                'name'                  => $request->name_en,
            ],
         ];
    }
}
