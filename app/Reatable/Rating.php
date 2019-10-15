<?php

namespace App\Reatable;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $table = 'ratings';

    protected $fillable = ['rating', 'user_id'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $userClassName = Config::get('auth.model');
        if (is_null($userClassName)) {
            $userClassName = Config::get('auth.providers.users.model');
        }

        return $this->belongsTo($userClassName);
    }
}
