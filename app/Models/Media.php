<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table      = 'media';
    protected $primaryKey = 'media_id';
    public $timestamps    = false;

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Placeholder global (1 file untuk semua entity)
     */
    public static function placeholder()
    {
        return self::where('ref_table', 'placeholder')
            ->where('ref_id', 0)
            ->first();
    }

    /**
     * Media entity atau fallback placeholder
     */
    public static function forEntityOrPlaceholder(string $refTable, int $refId)
    {
        $media = self::where('ref_table', $refTable)
            ->where('ref_id', $refId)
            ->orderBy('sort_order')
            ->first();

        return $media ?: self::placeholder();
    }
}
