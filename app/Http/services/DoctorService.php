<?php

namespace App\Http\services;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorService
{
    public function getWithPaginate(int $paginate = 5)
    {
        return Doctor::latest()->paginate($paginate);
    }

    public function getById($id)
    {
        return Doctor::where('id',$id)->firstOrFail();
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $doctor = Doctor::where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            })->paginate(5);
        } else {
            $doctor = Doctor::paginate(5);
        }
        return $doctor;
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|min:3',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:13',
            'address' => 'required'
        ]);
        Doctor::where('id', $id)->firstOrFail()->update($data);
    }

    public function create($request){
        $data = $request->validate([
            'name' => 'required|min:3',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:13',
            'address' => 'required'
        ]);

        Doctor::create($data);
    }
}
