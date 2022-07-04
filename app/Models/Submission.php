<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function filing_of_matter()
    {
        return $this->belongsTo(filingOfMatter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function judges()
    {
        return $this->belongsToMany(Judge::class);
    }

    public function lawyers()
    {
        return $this->belongsToMany(Lawyer::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
