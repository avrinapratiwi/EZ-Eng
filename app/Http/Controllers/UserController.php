<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showMentorAdmin()
    {
        $mentors = Mentor::all();
        return view('mentors-admin', compact('mentors'));
    }

    public function showLearnersAdmin()
    {
        $users = User::where('role', 'learner')->get();
        return view('learners-admin', compact('users'));
    }
    
    public function storeMentor(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:mentors,email',
            'phone_number' => 'required|max:13|unique:mentors,phone_number',
            'gender'       => 'required',
            'jenis'        => 'required|in:ekonomi,bisnis',
            'keterangan'   => 'nullable|string',
            'address'      => 'required',
        ]);
    
        Mentor::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'gender'       => $request->gender,
            'jenis'        => $request->jenis,
            'keterangan'   => $request->keterangan,
            'address'      => $request->address,
            'status'       => 'TIDAK AKTIF',
        ]);
    
        return redirect()->back()->with('success', 'Mentor successfully added!');
    }
    
    
    public function updateMentor(Request $request, $id)
    {
        $mentor = Mentor::findOrFail($id);
    
        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:mentors,email,' . $mentor->id,
            'phone_number' => 'required|max:13|unique:mentors,phone_number,' . $mentor->id,
            'gender'       => 'required',
            'jenis'        => 'required|in:ekonomi,bisnis',
            'keterangan'   => 'nullable|string',
            'address'      => 'required',
            'status'       => 'required',
        ]);
    
        $mentor->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'gender'       => $request->gender,
            'jenis'        => $request->jenis,
            'keterangan'   => $request->keterangan,
            'address'      => $request->address,
            'status'       => $request->status,
        ]);
    
        return redirect()->back()->with('success', 'Mentor successfully updated!');
    }
    
    
    public function deleteMentor($id)
    {
        Mentor::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Mentor successfully deleted!');
    }
    

}
