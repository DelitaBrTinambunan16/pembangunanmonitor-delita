<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kontraktor extends Model
{
    use HasFactory;

    // Nama tabel sesuai database
    protected $table = 'kontraktor';

    // Primary key
    protected $primaryKey = 'kontraktor_id';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'proyek_id',
        'nama',
        'penanggung_jawab',
        'kontak',
        'alamat',
    ];

    // Relasi ke Proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    // Scope filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope search
    public function scopeSearch(Builder $query, $request, array $searchableColumns): Builder
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
