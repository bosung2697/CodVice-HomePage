<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Service::latest()->get();
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
     * @param  \Illuminate\Http\Request $request
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
                if (!file_exists('fileuploaded/service')) {
                    File::makeDirectory('fileuploaded/service');
                    if (!file_exists('fileuploaded/service/images')) {
                        File::makeDirectory('fileuploaded/service/images');
                    }
                }
            }
        }
        $destinationPath = public_path('fileuploaded/service/images');
        $image = $request->file('images');

        $date=Carbon::now();


        $image_name = 'service'. '_' . $date . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $image_name);

        $data = new Service;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->classification = $request->classification;
        $data->images = 'fileuploaded/service/images/'.$image_name;
        $data->save();

        return view('Admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Service::find($id);
        return view('Admin.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
        $delete = Service::where('id', $id)->get();
        File::delete($delete['images']);

        if ($request->file('images')) {
            if (!file_exists('fileuploaded')) {
                File::makeDirectory('fileuploaded');
                if (!file_exists('fileuploaded/service')) {
                    File::makeDirectory('fileuploaded/service');
                    if (!file_exists('fileuploaded/service/images')) {
                        File::makeDirectory('fileuploaded/service/images');
                    }
                }
            }
        }
        $destinationPath = public_path('fileuploaded/service/images');
        $image = $request->file('images');

        $date=Carbon::now();

        $data1=Service::where('id', $id)->first();

        $image_name = 'service' . $data1->id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $image_name);

        $data = Service::where('id', $id)
            ->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'classification' => $request['classification'],
                'images' => 'fileuploaded/service/images/' . $image_name,
            ]);
        return redirect('admin/service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Service::where('id',$id)->get();
        if($delete['images'] != null){
            File::delete($delete['images']);
        }
        $data = Service::where('id', $id)->delete();
        return response()->json([], 204);
    }
}
