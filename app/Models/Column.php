<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = [
        'name',
        'position',
        'color',
    ];

    /**
     * Egy oszlophoz sok feladat tartozik.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
