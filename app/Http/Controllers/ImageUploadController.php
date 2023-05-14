<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;

class ImageUploadController extends Controller
{
    public function create()
    {
        return view('imageupload');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
                'filenames' => 'required',
                'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg'
        ]);
        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(base_path() . '/storage/app/public', $name);
                $data[] = $name;
            }
         }


         $file= new File();
         $file->filenames=json_encode($data);
         $file->save();


        return back()->with('success', 'Your files has been send successfully');
    }
}
