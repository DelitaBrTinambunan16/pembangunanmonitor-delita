<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table      = 'media';
    protected $primaryKey = 'media_id';
    public $timestamps    = false; // jika tabel kamu tidak pakai created_at & updated_at

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * OPTIONAL:
     * Relasi polymorphic manual berdasarkan ref_table dan ref_id
     */
    public function owner()
    {
        return $this->morphTo(null, 'ref_table', 'ref_id');
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'proyek')
            ->orderBy('sort_order');
    }

}
