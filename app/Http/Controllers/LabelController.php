<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label', [
            'except' => ['index', 'show'],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::orderBy('id', 'asc')->paginate();

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = new Label();

        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabelRequest $request)
    {
        $data = $request->validated();

        $label = new Label($data);
        $label->save();

        session()->flash('success', 'New label created successfully');

        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->fill($data)->save();

        session()->flash('success', 'Label edited successfully');

        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if (!empty($label->tasks()->first())) {
            session()->flash('error', "Не удалось удалить метку");
            return back();
        }
        $label->delete();

        session()->flash('success', "Label deleted successfully");

        return redirect()
            ->route('labels.index');
    }
}
