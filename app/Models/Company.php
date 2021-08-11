<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website_url',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
