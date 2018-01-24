<?php

namespace App\Modules\Document\Http\Controllers\category;

use App\Models\Document\Category;
use App\Models\Document\Document;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('document::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document::category.create');
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
            'contact_category_name' => 'required',
            'contact_category_description' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = new Category();

            $category->categoryName = $category_data['contact_category_name'];
            $category->summary = $category_data['contact_category_description'];
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;


            if ($category->save())
            {
                return redirect()
                    ->route('document_category_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category added successfully!');
            }
            else
            {
                return redirect()
                    ->route('document_category_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()
                ->route('document_category_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =Category::find($id);

        return view('document::category.edit', compact('category'));
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
            'contact_category_name' => 'required',
            'contact_category_description' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = Category::find($id);

            $category->categoryName = $category_data['contact_category_name'];
            $category->summary = $category_data['contact_category_description'];

            $category->updated_by = $updated_by;

            if ($category->update())
            {
                return redirect()
                    ->route('document_category_edit', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category updated successfully!');
            }
            else
            {
                return redirect()
                    ->route('document_category_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('document_category_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null)
    {

        if(!is_null($id)){
            $category = Category::find($id);

            if ($category->delete())
            {
                return redirect()
                    ->route('document_category')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category deleted successfully!');
            }
            else
            {
                return redirect()
                    ->route('document_category')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
            }
        }
        return redirect()
            ->route('document_category')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');

    }

    public function search($id)
    {
        $document = Document::where('documentcategory_id',$id)->get();


        return view('document::document.index', compact('document'));
    }
}
