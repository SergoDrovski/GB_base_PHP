<?php

namespace Src;

class Render
{
    private string $path;

    public function __construct ($path)
    {
        $this->path = $path;
    }

    public function showPage($filename, $params)
    {
        $pathFile = "{$this->path}{$filename}";
        $RenderPage = $this->renderTemp($pathFile, $params);
        return $RenderPage;
    }

    public function renderTemp(string $pathFile, $array)
    {
        if(file_exists($pathFile)) {
            ob_start();
            extract($array);
            require_once $pathFile;
            return ob_get_clean();
        }
        return "ошибка шаблонизации";
    }

}


