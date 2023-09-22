<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gourmet extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public static $rules = array(
        'shop_name' => 'required|max:20',
        'name_katakana' => 'required',
        'categories' => 'required|array',
        'review' => 'required',
        'comment' => 'required|max:300',
    );
    protected $table = 'restaurants';
}
