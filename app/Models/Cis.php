<?php // php artisan make:model Cis

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cis extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_cis';
}