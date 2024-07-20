<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Setting $setting;

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->setting->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Setting $setting)
    {
        $this->setting          = $setting;
        $this->mediaCollections = [

            'setting_logo' => $setting->logo,

        ];
    }

    public function render()
    {
        return view('livewire.setting.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->setting->save();
        $this->syncMedia();

        return redirect()->route('admin.settings.index');
    }

    protected function rules(): array
    {
        return [
            'setting.app_name' => [
                'string',
                'max:255',
                'nullable',
            ],
            'mediaCollections.setting_logo' => [
                'array',
                'nullable',
            ],
            'mediaCollections.setting_logo.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'setting.twitter_handle' => [
                'string',
                'max:255',
                'nullable',
            ],
            'setting.twitter_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'setting.facebook_url' => [
                'string',
                'nullable',
            ],
            'setting.youtube_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'setting.tiktok_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'setting.custom_url' => [
                'string',
                'max:255',
                'nullable',
            ],
        ];
    }
}
