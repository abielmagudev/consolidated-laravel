<?php 

namespace App\Ahex\Entrada\Application\Update;

use App\Ahex\Zkeleton\Application\Factory;

Class UpdaterFactory extends Factory
{
    public static function make($updatername, $params = [])
    {
        $factory = new self($updatername);
        return $factory->validate()->build($params);
    }

    private function __construct($updatername)
    {
        $this->filepath  = app_path('Ahex/Entrada/Application/Update/Updaters');
        $this->namespace = 'App\Ahex\Entrada\Application\Update\Updaters';
        $this->classname = ucfirst( strtolower($updatername) ) . 'Updater';
    }
}