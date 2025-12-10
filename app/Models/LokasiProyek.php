<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiProyek extends Model
{
    use HasFactory;

    protected $table      = 'lokasi_proyek';
    protected $primaryKey = 'lokasi_id';

    protected $fillable = [
        'proyek_id', 'lat', 'lng', 'geojson', 'files'
    ];

    // Relasi ke Proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    // Scope filter
    public function scopeFilter($query, $request, array $filterableColumns)
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope search
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

    // Ambil list file
    public function getFilesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Simpan list file sebagai JSON
    public function setFilesAttribute($value)
    {
        $this->attributes['files'] = json_encode($value);
    }
}
