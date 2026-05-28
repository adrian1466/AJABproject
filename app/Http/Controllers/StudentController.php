<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Degree;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $degrees = Degree::all();
        $students = Student::with('degree')->latest()->paginate(8);

        return view('students.index', compact('degrees', 'students'));
    }

    public function ajaxIndex()
    {
        $validated = request()->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:5', 'max:50'],
        ]);

        $search = $validated['search'] ?? null;
        $perPage = $validated['per_page'] ?? 8;

        $students = Student::with('degree')
            ->when($search, function ($query, string $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('student_id', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('degree', function ($degreeQuery) use ($search) {
                            $degreeQuery->where('degree_title', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'students' => $students->items(),
            'pagination' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
                'from' => $students->firstItem(),
                'to' => $students->lastItem(),
            ],
        ]);
    }

    public function exportData(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
        ]);

        $search = $request->query('search');

        $students = Student::with('degree')
            ->when($search, function ($query, string $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('student_id', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('degree', function ($degreeQuery) use ($search) {
                            $degreeQuery->where('degree_title', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return response()->json([
            'records' => $students->map(fn (Student $student) => $this->formatRecord($student))->values(),
        ]);
    }

    public function myRecord(Request $request)
    {
        $student = Student::with('degree')
            ->where('user_account_id', $request->session()->get('user_account_id'))
            ->first();

        return response()->json([
            'records' => $student ? [$this->formatRecord($student)] : [],
        ]);
    }

    public function create()
    {
        $degrees = Degree::all();
        return view('students.create', compact('degrees'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'student_id' => 'required|string|max:255',
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'contact_number' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students,email',
        //     'degree_id' => 'required|exists:degrees,id',
        // ]);

        $request->validate([
            'student_id' => ['nullable', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'digits:11'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:students,email', 'unique:user_accounts,email'],
            'degree_id' => ['required', 'exists:degrees,id'],
            'username' => ['required', 'string', 'max:100', 'unique:user_accounts,username'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        DB::transaction(function () use ($request) {
            $user = UserAccount::create([
                'username' => trim($request->input('username')),
                'email' => strtolower(trim($request->input('email'))),
                'password' => Hash::make($request->input('password')),
                'role' => 'student',
            ]);

            Student::create([
                'user_account_id' => $user->id,
                'student_id' => $request->student_id,
                'first_name' => trim($request->first_name),
                'last_name' => trim($request->last_name),
                'address' => trim($request->address),
                'contact_number' => $request->contact_number,
                'email' => strtolower(trim($request->email)),
                'degree_id' => $request->degree_id,
            ]);
        });

        $msg = "Student is Added!";
        Log::info($msg);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student added successfully.',
            ], 201);
        }

        return redirect('students')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('degree');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $degrees = Degree::all();
        return view('students.edit', compact('student', 'degrees'));
    }

    public function update(Request $request, Student $student)
    {
        // $request->validate([
        //     'student_id' => 'required|string|max:255',
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'contact_number' => 'required|integer',
        //     'email' => 'required|email|unique:students,email,' . $student->id,
        //     'degree_id' => 'required|exists:degrees,id',
        // ]);
        $request->validate([
            'student_id' => ['nullable', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'digits:11'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
                Rule::unique('students', 'email')->ignore($student->id),
                Rule::unique('user_accounts', 'email')->ignore($student->user_account_id),
            ],
            'degree_id' => ['required', 'exists:degrees,id'],
        ]);

        DB::transaction(function () use ($request, $student) {
            $email = strtolower(trim($request->email));

            $student->update([
                'student_id' => $request->student_id,
                'first_name' => trim($request->first_name),
                'last_name' => trim($request->last_name),
                'address' => trim($request->address),
                'contact_number' => $request->contact_number,
                'email' => $email,
                'degree_id' => $request->degree_id,
            ]);

            if ($student->userAccount) {
                $student->userAccount->update(['email' => $email]);
            }
        });
        
        $msg = "Student is Updated!";
        Log::info($msg);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student updated successfully.',
            ]);
        }

        return redirect('students')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $userAccount = $student->userAccount;
            $student->delete();

            if ($userAccount) {
                $userAccount->delete();
            }
        });

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Student deleted successfully.',
            ]);
        }

        return redirect('students')->with('success', 'Student deleted successfully.');
    }

    private function formatRecord(Student $student): array
    {
        return [
            'id' => $student->id,
            'user_account_id' => $student->user_account_id,
            'student_id' => $student->student_id,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'full_name' => trim($student->first_name.' '.$student->last_name),
            'address' => $student->address,
            'contact_number' => $student->contact_number,
            'email' => $student->email,
            'degree' => $student->degree?->degree_title ?? 'No Degree',
        ];
    }
}
