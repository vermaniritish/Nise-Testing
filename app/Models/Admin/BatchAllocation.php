<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BatchAllocation extends Model
{
    protected $table = 'batch_allocations';

    protected $fillable = [
        'batch_id',
        'center_id',
        'institute_id',
        'batch_strength',
        'state',
        'city',
        'sanction_date',
        'status',
        'allocated_doc',
    ];

    public function batch()
    {
        return $this->belongsTo(Batche::class, 'batch_id');
    }

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}
