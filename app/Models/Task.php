<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'column_id',
        'user_id',
        'name',
        'description',
        'position',
    ];

    /**
     * Egy feladat egy oszlophoz tartozik.
     */
    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    /**
     * Egy feladat egy felhasználóhoz tartozik.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
