<?php

namespace App\Http\Controllers\KeyActor;

use App\Models\Material;
use Illuminate\Http\Request;
// added
use App\Models\MaterialFiles;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class MaterialController extends Controller
{
    // display all module
    public function index()
    {
        $mats = DB::table('materials')->where('created_by', Auth::user()->id)->get();
        $mats = Material::sortable()->paginate(10);
        return view('key_actor.material.index', compact('mats'));
    }

    //search
    public function searchMaterials(Request $request)
    {
        if($request->search)
        {
            $search = Material::where('id', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('title', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('created_at', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('status', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('updated_at', 'LIKE', '%'.$request->search.'%')
                            ->paginate(11);
            return view('key_actor.material.search-module', compact('search'));//index
        }
        else
        {
            return view('key_actor.material.search-module');//index
        }
    }

    public function filterMaterials(Request $request)
    {
        // $createdDate = Carbon::now()->format('Y-m-d');
        $createdDate = $request->input('createdDate');
        $mats = Material::when($request->date != null, function ($q) use ($request) {
                        return $q->whereDate('created_at', $request->date);
                    }, function ($q) use ($createdDate){
                        return $q->whereDate('created_at', $createdDate);
                    })
                    // ->when($request->type != null, function ($q) use ($request) {
                    //     return $q->where('type', $request->type);
                    // })
                    // ->when($request->created_by != null, function ($q) use ($request) {
                    //     return $q->where('created_by', $request->created_by);
                    // })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('status', $request->status);
                    })
                    ->sortable()
                    ->paginate(11);

        return view('key_actor.material.filter-module', compact('mats'));
    }
    
    // view input create module
    public function create()
    {
        return view('key_actor.material.create');
    }

    // view manage material file
    public function manageMaterialFile($id)
    {
        $matfiles = Material::findorFail($id);
        return view('key_actor.material.managematerialfile')->with('matfiles', $matfiles);
    }

    // view edit input for material file
    public function editMaterialFile($id)
    {
        $file = MaterialFiles::findorFail($id);
        return view('key_actor.material.editmaterialfile', compact('file'));
    }

    // store material topic
    public function storeMaterial(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50', 'unique:materials'],
            'description' => ['required', 'string', 'max:10000'],
        ]);
        
        $mat = new Material([
            "title" => $request->title,
            "description" => $request->description,
            "created_by" => Auth::user()->id,
        ]);
        $mat->save();
        return redirect("/key_actor/material")->with('message', 'Material  added Successfully');
    }

    // store material file 
    public function storeMaterialFile(Request $request)
    {
        $validated = $request->validate([
            'file_title' => ['required', 'string', 'max:50', 'unique:material_files'],
            'file_description' => ['required', 'string', 'max:10000'],
            'file' => ['required', 'mimes:jpeg,png,jpg,zip,pdf,ppt, pptx, xlx, xlsx,d,webm,mp4,mpeg', 'max:180000'],
        ]);

        if ($request->hasFile("file")){
            $file = $request->file("file");
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("MaterialFiles/"), $fileName);

            $mat = new MaterialFiles([
                "file" => $fileName,
                "file_title" => $request->file_title,
                "file_description" => $request->file_description,
                "material_id" => $request->material_id,
                "file_status" => 0,
            ]);
            $mat->save();
        }
        return redirect("/key_actor/managematerialfile/$request->material_id")->with('message', 'Material File Added Successfully');
    }

    // update material files 
    public function updateMaterialFile(Request $request, $id)
    {
        $matfiles = MaterialFiles::findOrFail($id);

        if ($request->file_title or $request->file_description or $request->file !=''){
            if($request->file_title !=''){
                $validated = $request->validate([
                    'file_title' => ['required','string', 'max:50', 'unique:material_files'],
                ]);
                MaterialFiles::findOrFail($id)->update([
                    "file_title" => $request->file_title,
                ]);
            }

            if($request->file_description !=''){
                $validated = $request->validate([
                    'file_description' => ['required','string', 'max:1000'],
                ]);
                MaterialFiles::findOrFail($id)->update([
                    "file_description" => $request->file_description,
                ]);
            }


            if($request->file !=''){
                $validated = $request->validate([
                    'file' => ['required', 'mimes:jpeg,png,jpg,zip,pdf,ppt, pptx, xlx, xlsx,d,webm,mp4,mpeg', 'max:180000'],
                ]);

                if($request->hasFile("file")){
                    if(File::exists("MaterialFiles/".$matfiles->file)) {
                        File::delete("MaterialFiles/".$matfiles->file);
                    }
                    $file = $request->file("file");
                    $matfiles->file = time()."_".$file->getClientOriginalName();
                    $file->move(\public_path("/MaterialFiles"), $matfiles->file);
                    $request['file'] = $matfiles->file; 
                
                }

                MaterialFiles::findOrFail($id)->update([
                    "file" => $matfiles->file,
                ]);
            }   
        return redirect("/key_actor/editmaterialfile/$id")->with('message', 'Material File Updated Successfully');
        } else {
            return redirect("/key_actor/editmaterialfile/$id");
        }
    }

    // update material
    public function updateMaterial(Request $request, $id)
    {
        if ($request->title or $request->description !=''){
            if($request->title !=''){
                $validated = $request->validate([
                    'title' => ['required','string', 'max:50', 'unique:materials'],
                ]);
                Material::findOrFail($id)->update([
                    "title" => $request->title,
                ]);
            }

            if($request->description !=''){
                $validated = $request->validate([
                    'description' => ['required','string', 'max:1000'],
                ]);
                Material::findOrFail($id)->update([
                    "description" => $request->description,
                ]);
            }
            return redirect("/key_actor/managematerialfile/$id")->with('message', 'Material Updated Successfully');
        } else {
            return redirect("/key_actor/managematerialfile/$id");
        }
    }

    public function deleteMaterial($id)
    {
        $mat = Material::findOrFail($id);
        $matFiles = MaterialFiles::where("material_id",$mat->id)->get();
        foreach($matFiles as $matFile){
            if (File::exists("MaterialFiles/".$matFile->material_file)){
                File::delete("MaterialFiles/".$matFile->material_file);
            }
        }
        $mat->delete();
        return redirect("/key_actor/material")->with('message', 'Material  Deleted Successfully');
        
    }
    public function  deleteMaterialFiles($id){
        $file = MaterialFiles::findorFail($id)->file;
        if(File::exists("MaterialFiles/".$file)){
            File::delete("MaterialFiles/".$file);
            
        }
        MaterialFiles::find($id)->delete();
        
        return back()->with('message', 'Material File Deleted Successfully');
    }
}
