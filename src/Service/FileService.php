<?php

namespace CSVParser\Service;

class FileService{


    /**
     * Permet de vérifier si le fichier existe
     *
     * @param $path
     * @throws \Exception
     */
    public function exist($path) {
        if (! file_exists($path)) {
            throw new \Exception('[ERROR] Aucun fichier trouvé');
        }
    }

    /**
     * Permet de vérifier l'existance du fichier ainsi que sont extension
     *
     * @param string $path
     * @throws \Exception
     */
    public function csvVerify(string $path) {

        $this->exist($path);

        $file = explode('.',$path);
        $fileExt = end($file);

        if ($fileExt != "csv") {
            throw new \Exception('[ERROR] Merci de fournir un fichier CSV');
        }

    }


}