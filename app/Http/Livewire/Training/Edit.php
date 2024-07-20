<?php

namespace App\Http\Livewire\Training;

use App\Models\Training;
use App\Models\TrainingCategory;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Training $training;

    public array $mediaToRemove = [];

    public array $listsForFields = [];

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
                ->update(['model_id' => $this->training->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Training $training)
    {
        $this->training = $training;
        $this->initListsForFields();
        $this->mediaCollections = [

            'training_uploaded_video' => $training->uploaded_video,
        ];
    }

    public function render()
    {
        return view('livewire.training.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->training->save();
        $this->syncMedia();

        return redirect()->route('admin.trainings.index');
    }

    protected function rules(): array
    {
        return [
            'training.category_id' => [
                'integer',
                'exists:training_categories,id',
                'nullable',
            ],
            'training.slug' => [
                'string',
                'nullable',
            ],
            'training.type' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['type'])),
            ],
            'training.video_iframe' => [
                'string',
                'nullable',
            ],
            'mediaCollections.training_uploaded_video' => [
                'array',
                'nullable',
            ],
            'mediaCollections.training_uploaded_video.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['category'] = TrainingCategory::pluck('slug', 'id')->toArray();
        $this->listsForFields['type']     = $this->training::TYPE_SELECT;
    }
}
