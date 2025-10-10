<?php
namespace App\Models;

use App\Models\Biography;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['author_name', 'email'];

    public function biography()
    {
        return $this->hasOne(Biography::class);
    }
}
