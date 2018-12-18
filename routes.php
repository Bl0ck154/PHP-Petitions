<?php
    return array(
        '' => 'home/index',
        '/([-_a-zA-Z0-9]+)' => 'home/$1',
        '/([-_a-zA-Z0-9]+).php' => 'home/$1',
 //       '/([-_a-zA-Z0-9]+)/([-_a-zA-Z0-9]+)' => '$1/$2',
        '/petitions' => 'home/index',
        '/petitions/([-_a-zA-Z0-9]+)' => 'home/$1',
        '/petitions/([-_a-zA-Z0-9]+).php' => 'home/$1',
    );