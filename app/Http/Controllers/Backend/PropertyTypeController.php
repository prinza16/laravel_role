<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllType()
    {

        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));

    }

    public function AddType()
    {

        return view('backend.type.add_type');

    }

    public function StoreType(Request $request)
    {

        // Validation
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        Property::insert([

            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,

        ]);

        $notification = array(
            'message' => 'Property Type Create Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.type')->with($notification);

    }
}
