<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\folder;
use App\Models\File;
use App\Models\Filedata;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class AjaxFolderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = folder::where('user_id',$user_id)->get();
        $innerdata = File::where('user_id',$user_id)->get();
        return view('dashboard',['data' => $data, 'innerdata' => $innerdata]);
    }

    public function getdata(Request $request)
    {   
        $validatedData = $request->validate([
            'file' => 'required'
        ]);

        // return $request->file;
        $data = array();
        $user_id = Auth::user()->id;
        $folders = folder::where('user_id',$user_id)->get();
        $comment = comment::where('file_id',$request->file)->get();
        $code = Filedata::where('file_id',$request->file)->get();
        $innerdata = File::where('user_id',$user_id)->get();
        array_push($data,$folders,$comment,$code,$innerdata);
        return $data;
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

        // $data = Filedata::create($input);
        $data = Filedata::updateOrCreate(
            ['file_id' => $request->filename],
            $input
        );
 
        return $data;
        
    }

    public function storecomment(Request $request)
    {
        $validatedData = $request->validate([
          'filename' => 'required',
          'comment' => 'required'
        ]);

        $input = array(
            'file_id' => $request->filename,
            'comment' => $request->comment
        );

        $data = comment::create($input);
 
        return $data;
        
    }

    public function deletefolder(Request $request)
    {
        $validatedData = $request->validate([
          'folder' => 'required'
        ]);

        $data = folder::where('id',$request->folder)->delete();
        $data1 = File::where('parent_folder',$request->folder)->delete();
        $data2 = Filedata::where('file_id',$request->folder)->delete();
        return $data;
        
    }

    public function deletefile(Request $request)
    {
        $validatedData = $request->validate([
          'file' => 'required'
        ]);

        $data = File::where('id',$request->file)->delete();
        $data1 = Filedata::where('file_id',$request->file)->delete();
        return $data;
        
    }

}