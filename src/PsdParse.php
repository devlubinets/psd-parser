<?php

namespace PsdParse;

use Imagick;

class PsdParse
{
    private $tmpFile;

    private $psd;

    private \Imagick $output;

    /**
     * @param string $psd
     * @param Imagick $output
     */
    public function __construct(string $pathToPsd)
    {
        $this->tmpFile = fopen('./temp/temp.psd','w+');
        $this->psd = fopen($pathToPsd, 'r');
        $this->output = new  Imagick();
    }

    /* 2320090 sample file */
    /* 2320009 new file */
    public function replace(string $pattern, string $replacement)
    {
        while (($line = fgets($this->psd)) !== false) {
            $newLine = preg_replace($pattern, $replacement, $line);
            fwrite($this->tmpFile, $newLine);
        }
        fclose($this->tmpFile);
        fclose($this->psd);

        echo $this->saveInJPEG();
    }

    private function saveInJPEG(): string
    {
        $imagick = new \Imagick("./temp/temp.psd");

        $output = new \Imagick();
        $imagick->setIteratorIndex(1);
        $output->addImage($imagick->getimage());

        $imagick->setIteratorIndex(2);
        $output->addImage($imagick->getimage());

        $merged = @$output->flattenimages();
        $merged->setImageFormat('jpg');
        $merged->writeImage('./output/test.jpg');
    }
}