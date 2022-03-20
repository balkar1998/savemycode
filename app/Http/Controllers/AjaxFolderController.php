<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\folder;
use App\Models\File;
use App\Models\Filedata;
 
class AjaxFolderController extends Controller
{
    public function index()
    {
        $data = folder::get();
        $innerdata = File::get();
        return view('dashboard',['data' => $data, 'innerdata' => $innerdata ]);
    }
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'folder' => 'required',
          'user' => 'required'
        ]);

        $input = array(
            'name' => $request->folder,
            'user_id' => $request->user
        );

        $data = folder::create($input);
 
        return $data;
        
    }
   
    public function storefile(Request $request)
    {
        $validatedData = $request->validate([
          'filename' => 'required',
          'user' => 'required',
          'parentFolder' => 'required'
        ]);

        $input = array(
            'name' => $request->filename,
            'user_id' => $request->user,
            'parent_folder' => $request->parentFolder
        );

        $data = file::create($input);
 
        return $data;
        
    }

    public function storefilecontent(Request $request)
    {
        $validatedData = $request->validate([
          'filename' => 'required',
          'file_content' => 'required'
        ]);

        $input = array(
            'file_id' => $request->filename,
            'file_content' => $request->file_content
        );

        $data = Filedata::create($input);
 
        return $data;
        
    }
}