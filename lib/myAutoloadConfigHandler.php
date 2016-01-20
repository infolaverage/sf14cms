<?php
    class myAutoloadConfigHandler extends sfAutoloadConfigHandler{

        static public function parseFile($path, $file, $prefix)
        {
            $mapping = array();
            preg_match_all('~^\s*(?:abstract\s+|final\s+)?(?:class|interface|trait)\s+(\w+)~mi', file_get_contents($file), $classes);
            foreach ($classes[1] as $class)
            {
                $localPrefix = '';
                if ($prefix)
                {
                    // FIXME: does not work for plugins installed with a symlink
                    preg_match('~^'.str_replace('\*', '(.+?)', preg_quote(str_replace('/', DIRECTORY_SEPARATOR, $path), '~')).'~', str_replace('/', DIRECTORY_SEPARATOR, $file), $match);
                    if (isset($match[$prefix]))
                    {
                        $localPrefix = $match[$prefix].'/';
                    }
                }

                $mapping[$localPrefix.strtolower($class)] = $file;
            }

            return $mapping;
        }

    }
