<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('admin.news.index', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'images' => 'max:2000|mimes:jpeg,jpg,png'
        ]);

        if ($file = $request->file('images')) {
            $destinationPath = 'file/';
            $fileInput = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileInput);
            $data['images'] = $fileInput;
        }

        News::create($data);
        return redirect()->route('news')->with('success_message', 'Success!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', ['news' => $news]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $item = News::findOrFail($id);

        if ($file = $request->file('images')) {

            // Delete Old File
            $file_path = public_path() . '/file/' . $item['images'];
            File::delete($file_path);

            // Update New File
            $destinationPath = 'file/';
            $fileInput = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileInput);
            $data['images'] = $fileInput;
        }

        $item->update($data);

        return redirect()->route('news')->with('success_message', 'Success!');
    }

    public function destroy($id)
    {
        $data = News::findOrFail($id);
        $file_path = public_path() . '/file/' . $data['images'];
        File::delete($file_path);
        $data->delete();

        return redirect()->route('news')->with('success_message', 'Success!');
    }
}
