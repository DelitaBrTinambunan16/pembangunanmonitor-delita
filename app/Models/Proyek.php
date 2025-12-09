<?php
namespace App\Models;

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
        'lokasi',
        'anggaran',
        'sumber_dana',
        'deskripsi',
    ];

    // Function ini yang akan menjadi function untuk filter data sesuai request yang dikirimkan
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Relationships
     */
    public function progres()
    {
        return $this->hasMany(ProgresProyek::class, 'proyek_id', 'proyek_id');
    }

    public function lokasis()
    {
        return $this->hasMany(LokasiProyek::class, 'proyek_id', 'proyek_id');
    }

    public function kontraktors()
    {
        return $this->hasMany(Kontraktor::class, 'proyek_id', 'proyek_id');
    }
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
