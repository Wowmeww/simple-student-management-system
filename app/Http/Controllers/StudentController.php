<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StudentController extends Controller
{

    public function show(Student $student)
    {

        return view('student.show', [
            'student' => $student
        ]);
    }

    public function edit(Request $request, Student $student)
    {
        return view('student.edit', [
            'student' => $student
        ]);
    }
    public function update(Request $request, Student $student)
    {
        $fields = $request->validate([
            'age' => ['required', 'numeric', 'min:1', 'max:150'],
            'address' => ['required', 'string', 'max:254'],
            'course' => ['required', 'string', 'max:254'],
            'year' => ['required', 'numeric', 'max:254'],
            'sex' => ['required', 'max:254'],
            'name' => ['required', 'string', 'max:254']
        ]);

        $student->update(Arr::except($fields, 'name'));
        $student->user->update(Arr::only($fields, 'name'));

        return back()->with('message', 'Student information updated');
    }


    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return to_route('dashboard')->with('message', 'Student Account Deleted');
    }
}
