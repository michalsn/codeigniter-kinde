<?php

namespace Michalsn\CodeIgniterKinde\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Publisher\Publisher;
use Throwable;

/**
 * @codeCoverageIgnore
 */
class KindePublish extends BaseCommand
{
    protected string $group       = 'Kinde';
    protected string $name        = 'kinde:publish';
    protected string $description = 'Publish Kinde config file into the current application.';

    /**
     * @return void
     */
    public function run(array $params)
    {
        $source = service('autoloader')->getNamespace('Michalsn\\CodeIgniterKinde')[0];

        $publisher = new Publisher($source, APPPATH);

        try {
            $publisher->addPaths([
                'Config/Kinde.php',
            ])->merge(false);
        } catch (Throwable $e) {
            $this->showError($e);

            return;
        }

        foreach ($publisher->getPublished() as $file) {
            $contents = file_get_contents($file);
            $contents = str_replace('namespace Michalsn\\CodeIgniterKinde\\Config', 'namespace Config', $contents);
            $contents = str_replace('use CodeIgniter\\Config\\BaseConfig', 'use Michalsn\\CodeIgniterKinde\\Config\\Kinde as BaseKinde', $contents);
            $contents = str_replace('class Kinde extends BaseConfig', 'class Kinde extends BaseKinde', $contents);
            file_put_contents($file, $contents);
        }

        CLI::write(CLI::color('  Published! ', 'green') . 'You can customize the configuration by editing the "app/Config/Kinde.php" file.');
    }
}
