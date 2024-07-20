<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('ticket.merchant_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant">{{ trans('cruds.ticket.fields.merchant') }}</label>
        <x-select-list class="form-control" required id="merchant" name="merchant" :options="$this->listsForFields['merchant']" wire:model="ticket.merchant_id" />
        <div class="validation-message">
            {{ $errors->first('ticket.merchant_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ticket.fields.merchant_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ticket.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category">{{ trans('cruds.ticket.fields.category') }}</label>
        <x-select-list class="form-control" required id="category" name="category" :options="$this->listsForFields['category']" wire:model="ticket.category_id" />
        <div class="validation-message">
            {{ $errors->first('ticket.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ticket.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ticket.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.ticket.fields.status') }}</label>
        <select class="form-control" wire:model="ticket.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('ticket.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ticket.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('ticket.message') ? 'invalid' : '' }}">
        <label class="form-label required" for="message">{{ trans('cruds.ticket.fields.message') }}</label>
        <textarea class="form-control" name="message" id="message" required wire:model.defer="ticket.message" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('ticket.message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.ticket.fields.message_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>