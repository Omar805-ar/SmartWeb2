<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('training.category_id') ? 'invalid' : '' }}">
        <label class="form-label" for="category">{{ trans('cruds.training.fields.category') }}</label>
        <x-select-list class="form-control" id="category" name="category" :options="$this->listsForFields['category']" wire:model="training.category_id" />
        <div class="validation-message">
            {{ $errors->first('training.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.training.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('training.slug') ? 'invalid' : '' }}">
        <label class="form-label" for="slug">{{ trans('cruds.training.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" wire:model.defer="training.slug">
        <div class="validation-message">
            {{ $errors->first('training.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.training.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('training.type') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.training.fields.type') }}</label>
        <select class="form-control" wire:model="training.type">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['type'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('training.type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.training.fields.type_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('training.video_iframe') ? 'invalid' : '' }}">
        <label class="form-label" for="video_iframe">{{ trans('cruds.training.fields.video_iframe') }}</label>
        <textarea class="form-control" name="video_iframe" id="video_iframe" wire:model.defer="training.video_iframe" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('training.video_iframe') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.training.fields.video_iframe_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.training_uploaded_video') ? 'invalid' : '' }}">
        <label class="form-label" for="uploaded_video">{{ trans('cruds.training.fields.uploaded_video') }}</label>
        <x-dropzone id="uploaded_video" name="uploaded_video" action="{{ route('admin.trainings.storeMedia') }}" collection-name="training_uploaded_video" max-file-size="6000" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.training_uploaded_video') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.training.fields.uploaded_video_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>