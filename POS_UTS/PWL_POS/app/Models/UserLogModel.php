<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLogModel extends Model
{
    public $timestamps = false;
    protected $fillable = ['activity', 'performed_by', 'target', 'performed_at', 'detail'];
    protected $primaryKey = 'logs_id';
    protected $table = 'user_logs';


    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'performed_by', 'user_id');
    }
}
