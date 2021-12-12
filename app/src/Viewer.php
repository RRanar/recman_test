<?php

namespace App;

use App\Http\NotFoundHttpException;

class Viewer {

    const VIEWS_DIR = __DIR__. '/../views';

    const LAYOUTS_DIR = self::VIEWS_DIR. '/layouts';

    const VIEW_TEMPLATE_INDICATOR = '/\[\-([a-z]+)\-\]/';

    const VARIABLE_VIEW_INDICATOR = '/[\{]{2,2}([A-z]+)[\}]{2,2}/';

    public static function render(
        string $view,
        array $content,
        string $layout = ''
    )
    {
        $renderContent = '';

        $viewContent = self::getContentFromFile(
            self::getViewRealPath(
                $view
            )
        );

       if (!empty($layout)) {
            $layoutContent = self::getContentFromFile(
                self::getLayoutRealPath(
                    $layout
                )
            );

            $viewContent = self::replaceViewTemplateIndicator(
                $layoutContent,
                $viewContent
            );
       } 

       $viewContent = self::replaceVariableViewIndicator(
           $viewContent,
            $content
        );

        echo $viewContent;
    }


    private static function getContentFromFile(string $path)
    {
        ob_start();
        require_once($path);
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    private static function getLayoutRealPath(string $layout)
    {
        return self::getRealPath($layout, self::LAYOUTS_DIR);
    }

    private static function getViewRealPath(string $view)
    {
        return self::getRealPath($view, self::VIEWS_DIR);
    }

    private static function getRealPath(string $name, string $dir)
    {
        $realView = '';

        foreach (scandir($dir) as $file) {
            if (strpos($file, $name) !== false) {
                $realView = $dir. '/'. $file;
            }
        } 


        if (empty($realView)) {
            throw new NotFoundHttpException;
        }

        return $realView;
    }

    private static function replaceViewTemplateIndicator(string $layoutContent, string $viewContent) 
    {
        $newContent = preg_replace(
            self::VIEW_TEMPLATE_INDICATOR,
            $viewContent,
            $layoutContent
        );

        return $newContent;
    }

    private static function replaceVariableViewIndicator(string $viewContent, array $variables)
    {
        if (empty($variables)) {
            return $viewContent;
        }

        $matches = [];
        preg_match_all(self::VARIABLE_VIEW_INDICATOR, $viewContent, $matches);
        
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key) {
                if (in_array($key, array_keys($variables))) {
                    $viewContent = str_replace('{{'. $key . '}}', $variables[$key], $viewContent);
                }
            }
        }

        return $viewContent;
    }
}