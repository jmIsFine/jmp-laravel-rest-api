<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function index()
    {
        $person = Person::all();
        if ($person->count() > 0)
        {
            return response()->json([
                'status' => 200,
                'persons' => $person
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'No records found.'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:191',
            'Email' => 'required|email|max:191',
            'Phone' => 'required|digits:11',
         ]);

         if ($validator->fails())
         {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
         }
         else 
         {
            $person = Person::create([
                'Name' => $request->Name,
                'Email' => $request->Email,
                'Phone' => $request->Phone
            ]);

            if ($person)
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Created Successfully!'
                ], 200);
            }
            else 
            {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong!'
                ], 500);
            }
         }
    }

    public function show($id)
    {
        $person = Person::find($id);

        if ($person)
        {
            return response()->json([
                'status' => 200,
                'data' => $person
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'No records found.'
            ], 404);
        }
    }

    public function edit($id)
    {
        $person = Person::find($id);

        if ($person)
        {
            return response()->json([
                'status' => 200,
                'data' => $person
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'No records found.'
            ], 404);
        }
    }
    
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:191',
            'Email' => 'required|email|max:191',
            'Phone' => 'required|digits:11',
         ]);

         if ($validator->fails())
         {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
         }
         else 
         {
            $person = Person::find($id);

            if ($person)
            {
                $person->update([
                    'Name' => $request->Name,
                    'Email' => $request->Email,
                    'Phone' => $request->Phone
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Updated Successfully!'
                ], 200);
            }
            else 
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'No records found!'
                ], 404);
            }
         }
    }

    public function destroy($id)
    {
        $person = Person::find($id);

        if ($person)
        {
            $person->delete();

            return response()->json([
                'status' => 200,
                'data' => 'Deleted Successfully!'
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'No records found.'
            ], 404);
        }
    }
}
