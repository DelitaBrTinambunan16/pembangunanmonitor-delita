<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class LokasiProyek extends Model
{
    use HasFactory;

    protected $table      = 'lokasi_proyek';
    protected $primaryKey = 'lokasi_id';

    protected $fillable = [
        'proyek_id',
        'lat',
        'lng',
        'geojson',
    ];

    // ==================================================
    // RELASI
    // ==================================================

    // Relasi ke Proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    // 🔥 RELASI MEDIA (SAMA DENGAN PROYEK & PROGRES)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')
            ->where('ref_table', 'lokasi_proyek')
            ->orderBy('sort_order');
    }

    // ==================================================
    // SCOPE FILTER
    // ==================================================
    public function scopeFilter($query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // ==================================================
    // SCOPE SEARCH
    // ==================================================
    public function scopeSearch($query, $request, array $searchableColumns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
