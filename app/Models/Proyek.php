<?php
namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table      = 'proyek';
    protected $primaryKey = 'proyek_id';

    protected $fillable = [
        'kode_proyek',
        'nama_proyek',
        'tahun',
        'anggaran',
        'sumber_dana',
        'deskripsi',
    ];

    // =======================
    // Scope Filter
    // =======================
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // =======================
    // RELATIONSHIPS
    // =======================

    // Tahapan proyek
    public function tahapan()
    {
        return $this->hasMany(TahapanProyek::class, 'proyek_id', 'proyek_id');
    }

    // Progres proyek
    public function progres()
    {
        return $this->hasMany(ProgresProyek::class, 'proyek_id', 'proyek_id');
    }

    // Lokasi proyek
    public function lokasiProyek()
    {
        return $this->hasMany(LokasiProyek::class, 'proyek_id', 'proyek_id');
    }

    // Kontraktor proyek
    public function kontraktor()
    {
        return $this->hasMany(Kontraktor::class, 'proyek_id', 'proyek_id');
    }

    // Media proyek
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'proyek_id')
            ->where('ref_table', 'proyek');
    }

    // =======================
    // MEDIA + PLACEHOLDER GLOBAL (USER)
    // =======================

 public function mediaOrPlaceholder()
{
    return Media::forEntityOrPlaceholder('proyek', $this->proyek_id);
}

    // =======================
    // Scope Search
    // =======================
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        return $query;
    }
}
