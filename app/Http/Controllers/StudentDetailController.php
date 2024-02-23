<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentDetailController extends Controller
{
    public function index()
    {
        return view("student_detail.index");
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:student_details,email'],
            'number' => ['required', 'numeric', 'digits:10', 'unique:student_details,number'],
            'roll_number' => ['required', 'max:6', 'unique:student_details,roll_number'],
            'type' => ['required', 'in:hostel,day_scholar'],
            'address' => ['required', 'max:255'],
        ];
        $messages = [];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'roll_number' => $request->roll_number,
            'type' => $request->type,
            'address' => $request->address,
        ];
    
        $save = StudentDetail::create($data);
    
        if (!$save) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    
        return response()->json(['message' => 'Student Details created successfully!'], 201);
    }
    

    public function dataTable(Request $request)
    {
        $ajaxData = dataTableRequests($request->all());
        // Total records
        $query = StudentDetail::query();
        $totalRecords = $query->count();

        // search filter
        if (!empty($ajaxData['searchValue'])) {
            $query->where('name', 'like', '%' . $ajaxData['searchValue'] . '%');
        }
        $totalRecordswithFilter = $query->count();

        $records = $query->orderBy('id', 'DESC')
            ->skip($ajaxData['start'])
            ->take($ajaxData['rowperpage'])
            ->get();

        $data_arr = array();
        $sl = 1;
        foreach ($records as $record) {

            $button = "";

            $button .= '<a href="javascript:void(0);" class="link-primary fs-18" onclick="right_canvas(\'' . route('student.edit', encrypt($record->id)) . '\')"><i class="ri-edit-2-line"></i></a>';
            $button .= '<a href="javascript:void(0);" class="link-danger mx-2 mt-2 fs-18" onclick="cofirm_modal(\'' . route('student.delete', encrypt($record->id)) . '\', \'' . "datatable" . '\')"><i class="ri-delete-bin-2-line"></i></a>';

            $record->type = ucwords(str_replace('_', ' ', $record->type));

            $data_arr[] = array(
                "sl" => $sl,
                "name" => $record->name,
                "email" => $record->email,
                "roll_number" => $record->roll_number,
                "type" => $record->type,
                "number" => $record->number,
                "address" => $record->address,
                "action" => $button,
            );
            $sl++;
        }

        $response = array(
            "draw" => intval($ajaxData['draw']),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function edit($id)
    {
        $student = StudentDetail::where('id', decrypt($id))->first();
        return view('student_detail.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'number' => ['required', 'numeric', 'digits:10'],
            'roll_number' => ['required', 'max:6'],
            'type' => ['required', 'in:hostel,day_scholar'],
            'address' => ['required', 'max:255'],
        ];
    
        $messages = [];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $student_id = decrypt($request->student_id);
    
        $existingStudent = StudentDetail::where('id', '!=', $student_id)
            ->where(function ($query) use ($request) {
                $query->where('email', $request->email)
                    ->orWhere('number', $request->number)
                    ->orWhere('roll_number', $request->roll_number);
            })
            ->first();
    
        if ($existingStudent) {
            return response()->json(['message' => 'The provided email, number, or roll number already exists for another student.'], 500);
        }
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'roll_number' => $request->roll_number,
            'type' => $request->type,
            'address' => $request->address,
        ];
    
        $update_student = StudentDetail::where('id', $student_id)->update($data);
    
        if (!$update_student) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    
        return response()->json(['message' => 'Student Details updated successfully!'], 200);
    }
    

    public function delete($student_id)
    {
        $student_id = decrypt($student_id);

        $delete = StudentDetail::where('id', $student_id)->delete();

        if (!$delete) return response()->json(['message' => 'Something went wrong!'], 500);


        return response()->json(['message' => 'Student Details deleted successfully!'], 200);
    }
}
