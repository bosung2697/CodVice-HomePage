<?php

namespace App\Http\Controllers\Admin;

use App\System;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Image;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= System::latest()->get();
        return view('Admin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'classification' => 'required',
            'images' => 'required',
        ]);
        if ($request->file('images')) {
            if (!file_exists('fileuploaded')) {
                File::makeDirectory('fileuploaded');
                if (!file_exists('fileuploaded/system')) {
                    File::makeDirectory('fileuploaded/system');
                    if (!file_exists('fileuploaded/system/images')) {
                        File::makeDirectory('fileuploaded/system/images');
                    }
                }
            }
        }
        $destinationPath = public_path('fileuploaded/system/images');
        $image = $request->file('images');

        $date=Carbon::now();


        $image_name = 'system'. '_' . $date . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $image_name);

        $data = new System;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->classification = $request->classification;
        $data->images = 'fileuploaded/system/images/'.$image_name;
        $data->save();

        return view('Admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = System::find($id);
        return view('Admin.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'classification' => 'required',
            'images' => 'required',
        ]);
        $delete = System::where('id', $id)->get();
        File::delete($delete['images']);

        if ($request->file('images')) {
            if (!file_exists('fileuploaded')) {
                File::makeDirectory('fileuploaded');
                if (!file_exists('fileuploaded/system')) {
                    File::makeDirectory('fileuploaded/system');
                    if (!file_exists('fileuploaded/system/images')) {
                        File::makeDirectory('fileuploaded/system/images');
                    }
                }
            }
        }
        $destinationPath = public_path('fileuploaded/system/images');
        $image = $request->file('images');

        $date=Carbon::now();

        $data1=System::where('id', $id)->first();

        $image_name = 'system' . $data1->id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $image_name);

        $data = System::where('id', $id)
            ->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'classification' => $request['classification'],
                'images' => 'fileuploaded/system/images/' . $image_name,
            ]);
        return redirect('admin/system');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = System::where('id', $id)->first();
        if ($delete['images'] != null) {
            File::delete($delete['images']);
        }
        $data = System::where('id', $id)->delete();

        return response()->json([], 204);
    }
}
