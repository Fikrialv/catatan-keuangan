<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Menentukan kolom mana saja yang boleh diisi oleh user
    protected $fillable = ['type', 'amount', 'description', 'date'];
}
