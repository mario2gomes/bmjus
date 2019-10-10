<?php

class DATABASE_CONFIG {

    //Oracle
    public $default = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'bmjus',
        'password' => 'bmjus',
        'database' => '172.16.39.228/cbm',
        'prefix' => 'cor_',
        'encoding' => 'IS-8859-1'
    );

    //MySQL
    /*
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'port' => 3306,
        'login' => 'root',
        'password' => '',
        'database' => 'bmjus',
        'prefix' => 'cor_',
        'encoding' => 'utf8',
    );
    */

    public $bmrh = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'bmrh',
        'password' => 'bmrh112640',
        'database' => 'itechml-scan.itec.al.gov.br:1521/CBM',
        'prefix' => 'rh_',
        'encoding' => 'WE8MSWIN1252'
    );

    public $seg = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'producao',
        'password' => 'prod2904',
        'database' => 'itechml-scan.itec.al.gov.br:1521/CBM',
        'prefix' => 'seg_',
        'encoding' => 'WE8MSWIN1252'
    );

/*
    public $acl = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'bmjus',
        'password' => 'bmjus',
        'database' => '172.16.39.228/cbm',
        'prefix' => '',
        'encoding' => 'WE8MSWIN1252'
    );

   

    public $acl = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'sgo',
        'password' => 'sgo112640',
        'database' => '172.16.39.228:1521/CBM',
        'prefix' => '',
        'encoding' => 'WE8MSWIN1252'
    );

    public $default = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => '172.16.39.228',
        'port' => '1521',
        'login' => 'bmjus',
        'password' => 'bmjus',
        'database' => '100.50.0.3/BMJUS',
        //'prefix' => '',
        'encoding' => 'WE8MSWIN1252'
    );
    public $bmrh = array(
        'datasource' => 'Database/Oracle',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '1521',
        'login' => 'bmrh',
        'password' => 'bmrh112640',
        'database' => '172.16.39.228/desenv',
        'prefix' => 'rh_',
        'encoding' => 'WE8MSWIN1252'
    );

*/}
