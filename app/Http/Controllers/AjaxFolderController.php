<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\folder;
 
 
class AjaxFolderController extends Controller
{
    public function index()
    {
        $data = folder::get();
        return view('dashboard',['data' => $data]);
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
}