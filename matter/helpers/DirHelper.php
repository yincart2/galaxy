<?php
/**
 * @link http://www.yiikiwi.com/
 * @copyright Copyright (c) 2015 yiikiwi
 * @license http://www.yiikiwi.com/license/
 */

namespace matter\helpers;

use yii\base\InvalidParamException;

/**
 * Class DirHelper
 * @package kiwi\helpers
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class DirHelper
{
    /**
     * Returns the files found under the specified directory and subdirectories.
     * @param string $dir the directory under which the files will be looked for.
     * @param array $options options for file searching. Valid options are:
     *
     * - filter: callback, a PHP callback that is called for each directory or file.
     *   The signature of the callback should be: `function ($path)`, where `$path` refers the full path to be filtered.
     *   The callback can return one of the following values:
     *
     *   * true: the directory or file will be returned (the "only" and "except" options will be ignored)
     *   * false: the directory or file will NOT be returned (the "only" and "except" options will be ignored)
     *   * null: the "only" and "except" options will determine whether the directory or file should be returned
     *
     * - except: array, list of patterns excluding from the results matching file or directory paths.
     *   Patterns ending with '/' apply to directory paths only, and patterns not ending with '/'
     *   apply to file paths only. For example, '/a/b' matches all file paths ending with '/a/b';
     *   and '.svn/' matches directory paths ending with '.svn'.
     *   If the pattern does not contain a slash /, it is treated as a shell glob pattern and checked for a match against the pathname relative to $dir.
     *   Otherwise, the pattern is treated as a shell glob suitable for consumption by fnmatch(3) with the FNM_PATHNAME flag: wildcards in the pattern will not match a / in the pathname.
     *   For example, "views/*.php" matches "views/index.php" but not "views/controller/index.php".
     *   A leading slash matches the beginning of the pathname. For example, "/*.php" matches "index.php" but not "views/start/index.php".
     *   An optional prefix "!" which negates the pattern; any matching file excluded by a previous pattern will become included again.
     *   If a negated pattern matches, this will override lower precedence patterns sources. Put a backslash ("\") in front of the first "!"
     *   for patterns that begin with a literal "!", for example, "\!important!.txt".
     *   Note, the '/' characters in a pattern matches both '/' and '\' in the paths.
     * - only: array, list of patterns that the file paths should match if they are to be returned. Directory paths are not checked against them.
     *   Same pattern matching rules as in the "except" option are used.
     *   If a file path matches a pattern in both "only" and "except", it will NOT be returned.
     * - caseSensitive: boolean, whether patterns specified at "only" or "except" should be case sensitive. Defaults to true.
     * - recursive: boolean, whether the files under the subdirectories should also be looked for. Defaults to true.
     * @return array files found under the directory. The file list is sorted.
     * @throws InvalidParamException if the dir is invalid.
     */
    public static function findDirs($dir, $options = [])
    {
        if (!is_dir($dir)) {
            throw new InvalidParamException('The dir argument must be a directory.');
        }
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        $list = [];
        $handle = opendir($dir);
        if ($handle === false) {
            throw new InvalidParamException('Unable to open directory: ' . $dir);
        }
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (static::filterPath($path, $options)) {
                if (is_dir($path)) {
                    $list[] = $path;
                } elseif (isset($options['recursive']) && $options['recursive']) {
                    $list = array_merge($list, static::findDirs($path, $options));
                }
            }
        }
        closedir($handle);

        return $list;
    }

    /**
     * Checks if the given file path satisfies the filtering options.
     * @param string $path the path of the file or directory to be checked
     * @param array $options the filtering options. See [[findFiles()]] for explanations of
     * the supported options.
     * @return boolean whether the file or directory satisfies the filtering options.
     */
    public static function filterPath($path, $options)
    {
        if (isset($options['filter'])) {
            $result = call_user_func($options['filter'], $path);
            if (is_bool($result)) {
                return $result;
            }
        }

        if (empty($options['except']) && empty($options['only'])) {
            return true;
        }

        //@TODO

        return true;
    }
} 