<?php

namespace App\Modules\Contact\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Branch\Branch;
use App\Models\Contact\ContactCategory;

class CategoryWebController extends Controller
{
    public function index()
    {
        $categories = ContactCategory::all();

        return view('contact::category.index', compact('categories'));
    }

    public function create()
    {
        return view('contact::category.create');
    }

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

            $category = new ContactCategory;

            $category->contact_category_name = $category_data['contact_category_name'];
            $category->contact_category_description = $category_data['contact_category_description'];
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;


            if ($category->save())
            {
                return redirect()
                    ->route('category_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category added successfully!');
            }
            else
            {
                return redirect()
                    ->route('category_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()
                ->route('category_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = ContactCategory::find($id);

        return view('contact::category.edit', compact('category'));
    }

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

            $category = ContactCategory::find($id);

            $category->contact_category_name = $category_data['contact_category_name'];
            $category->contact_category_description = $category_data['contact_category_description'];
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;

            if ($category->update())
            {
                return redirect()
                    ->route('category_edit', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category updated successfully!');
            }
            else
            {
                return redirect()
                    ->route('category_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('category_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function destroy($id)
    {
        $category = ContactCategory::find($id);

        if ($category->delete())
        {
            return redirect()
                ->route('category')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Category deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('category')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }
}
