<?php

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\PatternLibraryBuilder\Symfony\Command;

use LIN3S\PatternLibraryBuilder\Loader\StyleguideConfigLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class LoadThumbnailsCommand extends Command
{
    private const CHROME_BIN = "/Applications/Google\ Chrome.app/Contents/MacOS/Google\ Chrome";
    private $configLoader;

    public function __construct(StyleguideConfigLoader $configLoader)
    {
        parent::__construct();
        $this->configLoader = $configLoader;
    }

    protected function configure()
    {
        $this->setName('lin3s:pattern-library-builder:load-thumbnails');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configs = $this->configLoader->allInPlain();

        foreach ($configs as $config) {
            $this->takeScreenshot($config);
        }
    }

    private function takeScreenshot(array $config)
    {
        $command = sprintf(
            '%s --headless --disable-gpu --screenshot="%s" http://localhost:8000%s?media=mobile',
            self::CHROME_BIN,
            __DIR__ . '/../' . mt_rand() . '.png',
            $config['slug'],
            array_keys($config['config']['preview_parameters'])[0]
        );

        exec($command);
    }
}
