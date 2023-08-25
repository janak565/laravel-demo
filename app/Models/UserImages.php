<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class UserImages extends Model
{
    use HasFactory, SoftDeletes;

      /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'file',
        'is_index',
    ];

     /**
     * The attributes that should be mutated to dates.
     * 
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

     /**
     * Get the user that owns the image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * check user id in current query .
     *
     */
    public function scopeUserId($query, $arg)
    {
        $query->where('user_id', '=', $arg)->first();
    }
    
}
