<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'luadm';

    /**
     * Name of the table.
     *
     * @var string
     */
    protected $table = 'luadm.sso_users';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Oracle binary columns.
     *
     * @var array
     */
    protected $binaries = ['settings'];
}
