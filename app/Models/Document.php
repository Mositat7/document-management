<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


  class Document extends Model
{
    protected $fillable = [
        'code',
        'title',
        'type',
        'sender',
        'receiver',
        'body',
        'status',
        'registered_at',
    ];

    public function attachments()
    {
        return $this->hasMany(DocumentAttachment::class);
    }
}
