<?php

namespace CSVParser;

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use CSVParser\Command\CSVParserCommand;
use CSVParser\Service\{
    CSVSerializerService,
    FileService,
    FormaterService
};


class CSVParser {

    /**
     * @var Application
     */
    private $application;

    public function __construct(Application $application) {
        $this->application = $application;
        $command = new CSVParserCommand(
            null,
            new CSVSerializerService(),
            new FileService(),
            new FormaterService()
        );
        $application->add($command);
    }

    public function init() {
        $this->application->run();
    }

}

$CSVParser = new CSVParser(new Application());
$CSVParser ->init();


