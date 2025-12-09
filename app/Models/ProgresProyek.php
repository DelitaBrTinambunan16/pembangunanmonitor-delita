<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    protected $table = 'progres_proyek';
    protected $primaryKey = 'progres_id';
    protected $fillable = [
        'proyek_id', 'tahap_id', 'persen_real', 'tanggal', 'catatan'
    ];

    // Relasi ke proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    // Relasi ke tahapan proyek
    public function tahap()
    {
        return $this->belongsTo(TahapanProyek::class, 'tahap_id');
    }

    // Scope filter
    public function scopeFilter($query, $request, $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    // Scope search
    public function scopeSearch($query, $request, $searchableColumns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'like', '%'.$request->search.'%');
                }
            });
        }
        return $query;
    }
}
