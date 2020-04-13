<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt'   => '83z6DT?1aEU#o8`j~1a10KbK7k5Dv2B$8V~Ifsjf;Jyi&G.a~Wan1atQ?DAd?1zKi!Jc1^2M8KV3#@fYd@SOnwNFhp~rha1aYJF!hI#NdchNmwxGM:AfgnT#hRE-%J5Do=3aC**aeeSBMz|cDmY6+2bhnsVArv0vZgBz$zbvSq9s~db%yq4,&b1aB',
            'length' => '20',
        ],

        'large' => [
            'salt'   => '3IupX2zUZcPaRYQeOjKdwn2g1ag0u7jstQ4e2pGsIZqfqaF6qLyujJOFh2A6phTE3Db0Fbjb6PbBzTYkNkATOKdNCpjz-XScTi7UqM1JMmbQ8zicYfaaZ5R8BJfcbmWAqo7I3oimetxU',
            'length' => '40',
        ],

        'small' => [
            'salt'   => '3IupX2zUZcPaRYQeOjKdwn2g1ag0u7jstQ4e2pGsIZqfqaF6qLyujJOFh2A6phTE3Db0Fbjb6PbBzTYkNkATOKdNCpjz-XScTi7UqM1JMmbQ8zicYfaaZ5R8BJfcbmWAqo7I3oimetxU',
            'length' => '5',
        ],

    ],

];
