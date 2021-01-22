<?php

namespace CSVParser\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class CSVSerializerService{

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var array
     */
    private $context = [
        CsvEncoder::DELIMITER_KEY => ';',
        CsvEncoder::ENCLOSURE_KEY => '"',
        CsvEncoder::ESCAPE_CHAR_KEY => '',
        CsvEncoder::ESCAPE_FORMULAS_KEY => false,
        CsvEncoder::HEADERS_KEY => [],
        CsvEncoder::KEY_SEPARATOR_KEY => '.',
        CsvEncoder::NO_HEADERS_KEY => false,
        CsvEncoder::AS_COLLECTION_KEY => true,
        CsvEncoder::OUTPUT_UTF8_BOM_KEY => false,
    ];

    /**
     * CSVSerializerService constructor.
     */
    public function __construct() {
        $encoder = [new CsvEncoder($this->context)];
        $this->serializer = new Serializer([],$encoder);
    }

    /**
     * @param string $file path of csv file
     * @return mixed
     */
    public function decode(string $file) {
        return $this->serializer->decode(file_get_contents($file), 'csv');
    }


}