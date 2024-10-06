<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Inertia\Inertia;
use Session;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\StorePatientRequest;

class PatientController extends Controller
{
    public function create()
    {
        return Inertia::render('Patients/Create');
    }

    public function store(StorePatientRequest $request)
    {
        $user = Patient::create([
            'name' => $request->name,
            'dui' => $request->dui,
            'gender' => $request->gender,
            'blood_type' => $request->blood_type,
            'blood_pressure' => $request->blood_pressure
        ]);

        return redirect('/dashboard')->with('successful', __('Paciente creado correctamente'));
    }

}
