<?php

namespace CSVParser\Service;

class FormaterService {


    /**
     * Permet de formater le header du future tableau
     *
     * @param $data
     * @return false|string[]
     */
    public function headers($data) {

        $tableHeader = array_keys($data[0]);
        array_splice($tableHeader,4,1);
        array_push($tableHeader,'slug');
        return $tableHeader;
    }


    /**
     * Permet de formater les rows
     *
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function rows($data) {

        $rows = [];
        foreach ($data as $d) {

            $values = array_values($d);
            $values[2] = $values[2] == 1 ? "Enabled" : "Disabled";

            $currency =  $values[4];
            array_splice($values,4,1);

            $values[3] = $this->price($values[3],$currency);
            $values[4] = $values[4];
            $values[5] = $this->date($values[5]);
            $values[6] = $this->slug($values[1]);

            array_push($rows,$values);
        }

        return $rows;
    }


    /**
     * Permet de formater le price
     *
     * @param $price
     * @param $currency
     * @param int $modeRound
     * @return string|string[]
     */
    public function price($price,$currency,$modeRound = PHP_ROUND_HALF_UP) {
        if($price != null) {
            $price = round($price, 3, $modeRound);
            $price = strval($price) . $currency;
            $price = str_replace('.', ',', $price);
        }
        return $price;
    }

    /**
     * Permet de formater la date de création
     *
     * @param null $date
     * @return false|string
     * @throws \Exception
     */
    public function date($date = null) {
        if($date != null) {
            $date = new \DateTime($date);
            $date = date_format($date, 'l, d-M-Y H:i:s e');
        }
        return $date;
    }

    /**
     * Permet de formater le slug
     *
     * @param $text
     * @return string
     */
    public function slug($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return $text;
    }





}