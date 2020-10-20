<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendFromDelegateToBanks extends Model
{
    protected $fillable =[
        'created_by',
        'image',
        'value',
        'number_order',
        'created_date',

    ];
    public function CreatedBy()
    {
        return $this->belongsTo(User::class , 'created_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'created_by');
    }
    public $appends = [
         'image_with_base',
    ];
    public function getImageWithBaseAttribute()
    {
        if (isset($this->attributes['image'])) {
            if ($this->attributes['image'] != null) {
                return asset($this->attributes['image']);
            }
        }

        return null;
    }

}
