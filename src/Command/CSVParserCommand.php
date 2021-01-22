<?php

namespace CSVParser\Command;

use CSVParser\Service\{
    CSVSerializerService,
    FileService,
    FormaterService,
    TableFormatService
};

use Symfony\Component\Console\{
    Command\Command,
    Input\InputArgument,
    Input\InputInterface,
    Output\OutputInterface,
    Style\SymfonyStyle
};


class CSVParserCommand extends Command
{

    protected static $defaultName = 'app:csv-parser';

    /**
     * @var CSVSerializerService
     */
    private $service;

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * @var FormaterService
     */
    private $formaterService;

    /**
     * CSVParserCommand constructor.
     * @param string|null $name
     * @param CSVSerializerService $CSVSerializerService
     * @param FileService $fileService
     * @param FormaterService $formaterService
     */
    public function __construct(
        string $name = null,
        CSVSerializerService $CSVSerializerService,
        FileService $fileService,
        FormaterService $formaterService
    )
    {
        parent::__construct($name);
        $this->service = $CSVSerializerService;
        $this->fileService = $fileService;
        $this->formaterService = $formaterService;
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setDescription('Commande permettant de récupérer un fichier CSV à partir de son path afin de la parser et de présenter')
            ->addArgument('CsvFilePath', InputArgument::REQUIRED, 'Le chemin du fichier CSV à parser')
            ->addOption('json','j',null,'Pour un resultat en json');
    }

    /**
     * Execute
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('CsvFilePath');
        $formatJson = $input->getOption('json');

        $this->fileService->csvVerify($file);

        $data = $this->service->decode($file);
        if(empty($data)) {
            $io->error('Aucune donnée');
            return;
        }

        $header = $this->formaterService->headers($data);
        $row = $this->formaterService->rows($data);

        if($formatJson) {
            $jsonResult = [];
            foreach ($row as $r) {
                $combine = array_combine ($header, $r );
                array_push($jsonResult,$combine);
            }
            dd(json_encode($jsonResult));
        }

        $io->table($header, $row);

    }




}
