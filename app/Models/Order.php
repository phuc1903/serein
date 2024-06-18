<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\HasApiTokens;

class Order extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'payment_method',
        'status',
        'total_price',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public static function getStatusOptions(): array
    {
        $results = DB::select("SHOW COLUMNS FROM orders WHERE Field = 'status'");

        $enumStr = $results[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumStr, $matches);
        $enumValues = explode(',', str_replace("'", "", $matches[1]));

        return $enumValues;
    }
}
