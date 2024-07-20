<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTrainigCategoryRequest;
use App\Models\TrainingCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('training_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training-category.index');
    }

    public function create()
    {
        abort_if(Gate::denies('training_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training-category.create');
    }

    public function edit(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training-category.edit', compact('trainingCategory'));
    }

    public function show(TrainingCategory $trainingCategory)
    {
        abort_if(Gate::denies('training_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training-category.show', compact('trainingCategory'));
    }
    public function update(UpdateTrainigCategoryRequest $request, int $id,)
    {
        abort_if(Gate::denies('training_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TrainingCategory::findOrFail($id)->update($this->processData($request));

        return redirect()->route('admin.training-categories.index');

    }
    public function processData($request) : array {
        return [
            'ar' => [
                'name'                  => $request->name_ar,
                'meta_description'      => $request->meta_description_ar,
            ],
            'en' => [
                'name'                  => $request->name_en,
                'meta_description'      => $request->meta_description_en,
            ],
            
         ];
    }

}
