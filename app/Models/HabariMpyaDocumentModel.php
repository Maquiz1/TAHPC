<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabariMpyaDocumentModel extends Model
{
    //
    use HasFactory;

    protected $table = 'habari_mpya_documents';
    protected $primaryKey = 'id';
    protected $fillable = ['habari_id','document_type','document_path','created_at','updated_at','status','created_by','updated_by','uuid'];
}
