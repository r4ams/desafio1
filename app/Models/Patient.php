<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    const GENDER_LABEL = [
      'man' => 'Hombre',
      'women' => 'Mujer'
    ];

    const BLOOD_TYPE_LABEL = [
      'a' => 'A',
      'b' => 'B',
      'ab' => 'AB',
      'o' => 'O',
    ];

    const BLOOD_PRESSURE_LABEL = [
      'low' => 'Bajo',
      'medium' => 'Medio',
      'high' => 'Alto'
    ];

    protected $table = 'patients';

    protected $fillable = [
      'name',
      'dui',
      'gender',
      'blood_type',
      'blood_pressure'
    ];
}
