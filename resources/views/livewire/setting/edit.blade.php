<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('setting.app_name') ? 'invalid' : '' }}">
        <label class="form-label" for="app_name">{{ trans('cruds.setting.fields.app_name') }}</label>
        <input class="form-control" type="text" name="app_name" id="app_name" wire:model.defer="setting.app_name">
        <div class="validation-message">
            {{ $errors->first('setting.app_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.app_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.setting_logo') ? 'invalid' : '' }}">
        <label class="form-label" for="logo">{{ trans('cruds.setting.fields.logo') }}</label>
        <x-dropzone id="logo" name="logo" action="{{ route('admin.settings.storeMedia') }}" collection-name="setting_logo" max-file-size="11" max-width="4096" max-height="4096" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.setting_logo') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.logo_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.twitter_handle') ? 'invalid' : '' }}">
        <label class="form-label" for="twitter_handle">{{ trans('cruds.setting.fields.twitter_handle') }}</label>
        <input class="form-control" type="text" name="twitter_handle" id="twitter_handle" wire:model.defer="setting.twitter_handle">
        <div class="validation-message">
            {{ $errors->first('setting.twitter_handle') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.twitter_handle_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.twitter_url') ? 'invalid' : '' }}">
        <label class="form-label" for="twitter_url">{{ trans('cruds.setting.fields.twitter_url') }}</label>
        <input class="form-control" type="text" name="twitter_url" id="twitter_url" wire:model.defer="setting.twitter_url">
        <div class="validation-message">
            {{ $errors->first('setting.twitter_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.twitter_url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.facebook_url') ? 'invalid' : '' }}">
        <label class="form-label" for="facebook_url">{{ trans('cruds.setting.fields.facebook_url') }}</label>
        <input class="form-control" type="text" name="facebook_url" id="facebook_url" wire:model.defer="setting.facebook_url">
        <div class="validation-message">
            {{ $errors->first('setting.facebook_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.facebook_url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.youtube_url') ? 'invalid' : '' }}">
        <label class="form-label" for="youtube_url">{{ trans('cruds.setting.fields.youtube_url') }}</label>
        <input class="form-control" type="text" name="youtube_url" id="youtube_url" wire:model.defer="setting.youtube_url">
        <div class="validation-message">
            {{ $errors->first('setting.youtube_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.youtube_url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.tiktok_url') ? 'invalid' : '' }}">
        <label class="form-label" for="tiktok_url">{{ trans('cruds.setting.fields.tiktok_url') }}</label>
        <input class="form-control" type="text" name="tiktok_url" id="tiktok_url" wire:model.defer="setting.tiktok_url">
        <div class="validation-message">
            {{ $errors->first('setting.tiktok_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.tiktok_url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.custom_url') ? 'invalid' : '' }}">
        <label class="form-label" for="custom_url">{{ trans('cruds.setting.fields.custom_url') }}</label>
        <input class="form-control" type="text" name="custom_url" id="custom_url" wire:model.defer="setting.custom_url">
        <div class="validation-message">
            {{ $errors->first('setting.custom_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.custom_url_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>