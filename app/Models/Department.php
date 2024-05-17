<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'dp_name', 'dp_parent_id', 'dp_content', 'created_at','updated_at'
    ];

    public function parent(){
        return $this->hasOne(self::class, 'id', 'dp_parent_id')->select('id', 'dp_name');
    }

    public function parents()
    {
        return $this->hasMany(self::class, 'dp_parent_id', 'id');
    }

    public function getDepartments ()
    {
        return $this->with('parents')->where('dp_parent_id', 0)->get();
    }
}
