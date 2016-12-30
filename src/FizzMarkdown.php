<?php
namespace Fizzday\FizzMarkdown;

/**
 * markdown解析器
 * Class FizzMarkdown
 * @package Fizzday\FizzMarkdown
 */
class FizzMarkdown
{
    private static $config = array();
    private static $title  = 'markdown parser';

    public static function setConf($config = array('mdDir' => '', 'htmlDir' => '', 'startNo' => 1))
    {
        static::$config = $config;

        return new static();
    }

    public static function setTitle($title = 'markdown parser')
    {
        static::$title = $title;

        return new static();
    }

    /**
     * 单个文件解析
     * @param string $md    文件(或者markdown内容)
     * @param bool $text    是否返回文本
     * @return string       文件名/文本
     */
    public static function parse($md = '', $text = false)
    {
        if (is_file($md)) $md = file_get_contents($md);
        $fileName = time() . '.html';

        $res = static::handle($md);

        if (!$text) {
            if (file_exists($fileName)) unlink($fileName);
            file_put_contents($fileName, $res);

            return $fileName;
        } else {
            return $res;
        }
    }

    public static function multiParse()
    {

    }

    private static function handle($main = '')
    {
        $md = '';
        $md .= static::createMdHeader();
        $md .= $main;
        $md .= static::createMdFooter();

        return $md;
    }

    private static function createMdHeader()
    {
        $html = '<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>' . static::$title . '</title>
<xmp theme="united" style="display:none;">
';

        return $html;
    }

    private static function createMdFooter()
    {
        $html = '
</xmp>
<script src="http://strapdownjs.com/v/0.2/strapdown.js"></script>
</html>
';

        return $html;
    }
}
