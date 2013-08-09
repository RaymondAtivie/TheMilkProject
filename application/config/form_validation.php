<?php

$config = array(
    'sell' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|min_length[3]'
        ),
        array(
            'field' => 'category',
            'label' => 'Category',
            'rules' => 'required|callback_is_default_select'
        ),
        array(
            'field' => 'price',
            'label' => 'Price',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'duration',
            'label' => 'Duration',
            'rules' => 'trim'
        ),
        array(
            'field' => 'min_increment',
            'label' => 'Minimum Increament',
            'rules' => 'trim'
        )
    ),
    
    'login' => array(
        array(
            'field'=>'username',
            'label'=>'Username',
            'rules'=>'trim|required'
        ),
        array(
            'field'=>'password',
            'label'=>'Password',
            'rules'=>'trim|required|callback_check_login'
        ),
        array(
            'field'=>'remember_me',
            'label'=>'Remember Me',
            'rules'=>'trim'
        )
    )
);
