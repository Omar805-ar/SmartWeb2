@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.training.title_singular') }}:
                    {{ trans('cruds.training.fields.id') }}
                    {{ $training->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.id') }}
                            </th>
                            <td>
                                {{ $training->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.category') }}
                            </th>
                            <td>
                                @if($training->category)
                                    <span class="badge badge-relationship">{{ $training->category->slug ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.slug') }}
                            </th>
                            <td>
                                {{ $training->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.type') }}
                            </th>
                            <td>
                                {{ $training->type_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.video_iframe') }}
                            </th>
                            <td>
                                {{ $training->video_iframe }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.training.fields.uploaded_video') }}
                            </th>
                            <td>
                                @foreach($training->uploaded_video as $key => $entry)
                                    <a class="link-light-blue" href="{{ $entry['url'] }}">
                                        <i class="far fa-file">
                                        </i>
                                        {{ $entry['file_name'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('training_edit')
                    <a href="{{ route('admin.trainings.edit', $training) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection