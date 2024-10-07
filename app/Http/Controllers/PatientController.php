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
use Illuminate\Support\Facades\DB;

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

        return redirect()->route('dashboard')->with('successful', 'Paciente creado correctamente');
    }

    public function index()
    {
        // Obtener todos los pacientes
        $patients = Patient::all();

        // Agrupar por género
        $groupedByGender = $patients->groupBy('gender');

        // Crear la estructura base
        $treeData = [
            'value' => 'Pacientes',
            'avatar' => "/images/pacientes.jpeg",
            'name' => 'Pacientes',
            'image_url' => "/images/pacientes.jpeg",
            'class' => ["rootNode"],
            'children' => [
                [
                    'name' => 'Género',
                    'image_url' => "/images/genero.jpeg",
                    'value' => 'Género',
                    'avatar' => "/images/genero.jpeg",
                    'children' => []
                ],
                [
                    'name' => 'Tipo de Sangre',
                    'image_url' => "/images/tipo-sangre.jpeg",
                    'value' => 'Tipo de Sangre',
                    'avatar' => "/images/tipo-sangre.jpeg",
                    'children' => []
                ],
                [
                    'name' => 'Presión',
                    'image_url' => "/images/presion-arterial.jpeg",
                    'value' => 'Presión',
                    'avatar' => "/images/presion-arterial.jpeg",
                    'children' => []
                ]
            ]
        ];

        // Llenar el nodo de Género
        foreach ($groupedByGender as $gender => $patientsByGender) {
            $genderNode = [
                'value' => Patient::GENDER_LABEL[$gender],
                'avatar' => 'https://placehold.co/600x400?text=' . Patient::GENDER_LABEL[$gender],
                'name' => Patient::GENDER_LABEL[$gender],
                'image_url' => 'https://placehold.co/600x400?text=' . Patient::GENDER_LABEL[$gender],
                'extend' => false,
                'children' => $patientsByGender->map(function ($patient) {
                    return [
                        'full_name' => $patient->name,
                        'name' => $patient->dui,
                        'gender' => Patient::GENDER_LABEL[$patient->gender],
                        'image_url' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg',
                        'value' => $patient->dui,
                        'blood_type' => Patient::BLOOD_TYPE_LABEL[$patient->blood_type],
                        'blood_pressure' => Patient::BLOOD_PRESSURE_LABEL[$patient->blood_pressure],
                        'avatar' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg'
                    ];
                })->values()->toArray()
            ];
            
            // Agregar el nodo de género al árbol
            $treeData['children'][0]['children'][] = $genderNode; // Añadir al primer nodo (Género)
        }

        // Llenar el nodo de Tipo de Sangre
        $groupedByBloodType = $patients->groupBy('blood_type');
        foreach ($groupedByBloodType as $bloodType => $patientsByBloodType) {
            $bloodTypeNode = [
                'name' => Patient::BLOOD_TYPE_LABEL[$bloodType],
                'image_url' => 'https://placehold.co/600x400?text=' . Patient::BLOOD_TYPE_LABEL[$bloodType],
                'value' => Patient::BLOOD_TYPE_LABEL[$bloodType],
                'avatar' => 'https://placehold.co/600x400?text=' . Patient::BLOOD_TYPE_LABEL[$bloodType],
                'extend' => false,
                'children' => $patientsByBloodType->map(function ($patient) {
                    return [
                        'full_name' => $patient->name,
                        'name' => $patient->dui,
                        'gender' => Patient::GENDER_LABEL[$patient->gender],
                        'image_url' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg',
                        'value' => $patient->dui,
                        'blood_type' => Patient::BLOOD_TYPE_LABEL[$patient->blood_type],
                        'blood_pressure' => Patient::BLOOD_PRESSURE_LABEL[$patient->blood_pressure],
                        'avatar' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg'
                    ];
                })->values()->toArray()
            ];
            
            // Agregar el nodo de tipo de sangre al árbol
            $treeData['children'][1]['children'][] = $bloodTypeNode; // Añadir al segundo nodo (Sangre)
        }

        // Llenar el nodo de Presión Arterial
        $groupedByBloodPressure = $patients->groupBy('blood_pressure');
        foreach ($groupedByBloodPressure as $bloodPressure => $patientsByBloodPressure) {
            $bloodPressureNode = [
                'name' => Patient::BLOOD_PRESSURE_LABEL[$bloodPressure],
                'image_url' => 'https://placehold.co/600x400?text=' . Patient::BLOOD_PRESSURE_LABEL[$bloodPressure],
                'value' => Patient::BLOOD_PRESSURE_LABEL[$bloodPressure],
                'avatar' => 'https://placehold.co/600x400?text=' . Patient::BLOOD_PRESSURE_LABEL[$bloodPressure],
                'extend' => false,
                'children' => $patientsByBloodPressure->map(function ($patient) {
                    return [
                        'full_name' => $patient->name,
                        'name' => $patient->dui,
                        'gender' => Patient::GENDER_LABEL[$patient->gender],
                        'image_url' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg',
                        'value' => $patient->dui,
                        'blood_type' => Patient::BLOOD_TYPE_LABEL[$patient->blood_type],
                        'blood_pressure' => Patient::BLOOD_PRESSURE_LABEL[$patient->blood_pressure],
                        'avatar' => $patient->gender === 'male' ? 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_male3.svg' : 'https://live.yworks.com/demos/complete/interactiveorgchart/resources/usericon_female3.svg'
                    ];
                })->values()->toArray()
            ];
            
            // Agregar el nodo de presión arterial al árbol
            $treeData['children'][2]['children'][] = $bloodPressureNode; // Añadir al tercer nodo (Presión)
        }

        // Convertir a JSON
        $jsonData = response()->json($treeData);

        // dd($jsonData);
        return Inertia::render('Patients/Index',['patients' =>$jsonData]);
    }

}
