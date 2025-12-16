<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    use HasFactory;

    protected $table = 'progres_proyek';
    protected $primaryKey = 'progres_id';

    protected $fillable = [
        'proyek_id',
        'tahap_id',
        'persen_real',
        'tanggal',
        'catatan'
    ];

    // Relasi ke proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    // Relasi ke tahapan proyek
    public function tahapan()
    {
        return $this->belongsTo(TahapanProyek::class, 'tahap_id', 'tahap_id');
    }

    // Relasi ke media progres
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'progres_id')
                     ->where('ref_table', 'progres_proyek');
    }
    // FILTER
public function scopeFilter($query, $request, array $columns)
{
    foreach ($columns as $col) {
        if ($request->filled($col)) {
            $query->where($col, $request->$col);
        }
    }
    return $query;
}

// SEARCH
public function scopeSearch($query, $request, array $columns)
{
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request, $columns) {
            foreach ($columns as $col) {
                $q->orWhere($col, 'LIKE', '%' . $request->search . '%');
            }
        });
    }
    return $query;
}

}
