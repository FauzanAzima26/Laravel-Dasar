<?php

namespace App\Http\Controllers;

use App\Http\services\DoctorService;
use App\Models\Doctor;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(private DoctorService $doctorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = $this->doctorService->getWithPaginate(5);
        return view('doctor.index', [
            'doctors' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->doctorService->create($request);
        return redirect(url('doctor'))->with('success', 'Doctor created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->doctorService->getById($id);
        return view('doctor.edit', [
            'doctor' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->doctorService->update($request, $id);
        return redirect(url('doctor'))->with('success', 'Doctor berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->doctorService->getById($id);
        $data->delete();
        return redirect(url('doctor'))->with('success', 'Doctor deleted successfully!');
    }

    public function search(Request $request)
    {
        $data = $this->doctorService->search($request);
        return view('doctor.index', [
            'doctors' => $data,
        ]);
    }
}
