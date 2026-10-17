<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{    
    use Hasfactory;   
    protected $fillable =[
        'nama',
        'email',
        'alamat',
        'telepon',
        'nis_nim',
        ];
     use HasFactory;
     public function loans()
 {
 return $this->hasMany(Loan::class);
 }
}
