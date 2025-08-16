<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function master_items()
    {
        return $this->belongsToMany(MasterItem::class, 'item_kategori', 'kategori_id', 'master_item_id');
    }
}
