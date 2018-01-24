<?php

namespace App\Modules\Document\Http\Controllers\document;

use App\Models\Document\Document;
use App\Models\Document\Category;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class WebController extends Controller
{

    public function index()
    {
        $document = Document::all();

       return view('document::document.index', compact('document'));
    }


    public function create($id)
    {

        $categories = Category::all();
        $pax = Recruitorder::all();
        return view('document::document.create', compact('categories','pax','id'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'title'=> 'required',
            'contact_category_id'=> 'required',
            'pax_id'=> 'required',
            'file_url'=> 'required|max:20000',

        ]);

        try
        {
            $contact = new Document();
            $data = $request->all();
            //return $data['user_edit_avatar_control'];

            if($request->hasFile('file_url'))
            {
                $file = $request->file('file_url');
                //return $file;

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;

                $success = $file->move('uploads/contact',$new_file_name);

                if($success)
                {
                    $contact->file_url = 'uploads/contact/'.$new_file_name;
                }
            }

            $user_id = Auth::user()->id;


            $contact->documentcategory_id = $data['contact_category_id'];
            $contact->title = $data['title'];
            $contact->pax_id = $data['pax_id'];
            $contact->notes = $data['note'];
            $contact->notes = $data['note'];

            $contact->created_by = $user_id;
            $contact->updated_by = $user_id;


            if ($contact->save())
            {
                return redirect()
                    ->route('document')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Document added successfully!');
            }
            else
            {
                return redirect()
                    ->route('document')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        $document =Document::all();
        $category = Category::all();

        $recruit = Recruitorder::find($id);

        foreach ($document as $value){
            if ($value->pax_id==$recruit->id){

                return view('document::document.edit', compact('category','pax','id','document','recruit'));
            }
        }
        return Redirect::route('document_create',$id);

    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title'=> 'required',
            'contact_category_id'=> 'required',
            'pax_id'=> 'required',
            'file_url'=> 'max:20000',

        ]);


        try
        {

            $data = $request->all();

            $user_id = Auth::user()->id;

            $contact = Document::find($id);


            if($request->hasFile('file_url'))
            {
                if($contact->file_url)
                {
                    $delete_path = public_path($contact->file_url);
                    $delete = unlink($delete_path);
                }

                $file = $request->file('file_url');
                //return $file;

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;

                $success = $file->move('uploads/contact',$new_file_name);

                if($success)
                {
                    $contact->file_url = 'uploads/contact/'.$new_file_name;
                }
            }

            $contact->documentcategory_id   = $data['contact_category_id'];
            $contact->title            = $data['title'];
            $contact->pax_id             = $data['pax_id'];
            $contact->notes          = $data['note'];
            $contact->updated_by            = $user_id;



            if ($contact->update())
            {
                return redirect()
                    ->route('document', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Document Update successfully!');
            }
            else
            {
                return redirect()
                    ->route('contact_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be Update.');
            }
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }


    public function destroy($id =null)
    {
        if(!is_null($id)){
            $category = Document::find($id);
            if(file_exists(public_path($category->file_url))){


                unlink(public_path($category->file_url));



            }

            if ($category->delete())
            {
                return redirect()
                    ->route('document')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Document deleted successfully!');
            }
            else
            {
                return redirect()
                    ->route('document')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
            }
        }
        return redirect()
            ->route('document')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
    }

}
