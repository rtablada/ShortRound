<?php

use App\Menu;
use Illuminate\Database\Eloquent\Model;
use Rtablada\ShortRound\Database\EloquentSeeder;

class MenuSeeder extends EloquentSeeder
{

    protected $model = 'App\Menu';

    protected $seeds = [
        [
            'name'     => 'Admin',
            'base_url' => '/admin',
            'children' => [
                [
                    'name' => 'Users',
                    'url'  => 'users'
                ],
                [
                    'name' => 'Copy',
                    'url'  => 'copy'
                ],
            ],
        ]
    ];

}
