<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainigRequest;
use App\Models\Merchant;
use App\Models\TicketCategory;
use App\Models\Training;
use App\Models\TrainingCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    public Training $training;
    public function __construct(Training $training)
    {
        $this->training = $training;

    }
    public function index()
    {
        abort_if(Gate::denies('training_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training.index');
    }

    public function create()
    {
        abort_if(Gate::denies('training_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listsForFields['category'] = TrainingCategory::pluck('slug', 'id')->toArray();
        $listsForFields['type']     = $this->training::TYPE_SELECT;


        return view('admin.training.create', compact('listsForFields'));
    }

    public function edit(Training $training)
    {
        abort_if(Gate::denies('training_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.training.edit', compact('training'));
    }

    public function show(Training $training)
    {
        abort_if(Gate::denies('training_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training->load('category');

        return view('admin.training.show', compact('training'));
    }
    public function store(StoreTrainigRequest $request)
    {
        DB::beginTransaction();
        try {
             Training::create([
                'ar'    => [
                    'name'          => $request->name_ar,
                    'description'   => $request->description_ar,
                ],
                'en'    => [
                    'name'          => $request->name_en,
                    'description'   => $request->description_en,
                ],
                'type'              => $request->type,
                'video_iframe'      => $request->video_iframe,
                'category_id'       => $request->category_id
             ]);
             DB::commit();
             return redirect()->route('admin.trainings.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }
    public function storeMedia(Request $request)
    {
        abort_if(Gate::denies('training_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model                     = new Training();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}
