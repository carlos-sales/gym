<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Domain;
use App\Models\Traits\HasDatabase;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Models\Tenant;

class Academia extends Model
{
    use HasFactory;
    use HasDatabase;

    protected $fillable = [
        'nome',
        'database'
    ];

    public function domains()
    {
        return $this->hasMany(Domain::class, 'tenant_id');
    }
}
