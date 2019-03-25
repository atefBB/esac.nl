<?php

namespace App\Model\Declaration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Declaration extends Model
{
    use SoftDeletes;

    //states
    const STATE_PENDING = "STATE_PENDING";
    const STATE_APPROVED = "STATE_APPROVED";
    const STATE_DECLINED = "STATE_DECLINED";

    //types
    const TYPE_ESAC_PAS = "TYPE_ESAC_PAS";
    const TYPE_SELF_PAY = "TYPE_SELF_PAY";

    protected $fillable = [
        'user_id',
        'state',
        'short_description',
        'long_description',
        'amount',
        'type',
        'date',
        'pdf_url',
    ];

    protected $dates = [
        'date'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id')->withThrashed();
    }
}
