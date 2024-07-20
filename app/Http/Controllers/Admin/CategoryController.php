<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.index');
    }

    public function create()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.create');
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.edit', compact('category'));
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.show', compact('category'));
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->update($this->processData($request));

        return redirect()->route('admin.categories.index');

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
            'icon'              => $request->icon
         ];
    }
}
