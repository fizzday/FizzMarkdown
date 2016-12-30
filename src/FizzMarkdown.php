<?php
namespace Fizzday\FizzMarkdown;

/**
 * markdown解析器
 * Class FizzMarkdown
 * @package Fizzday\FizzMarkdown
 */
class FizzMarkdown
{
    /**
     * 总标题
     * @var string
     */
    private static $title  = 'markdown parser';

    /**
     * 设置总标题
     * @param string $title
     * @return static
     */
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

        $res = self::handle($md);

        if (!$text) {
            if (file_exists($fileName)) unlink($fileName);
            file_put_contents($fileName, $res);

            return $fileName;
        } else {
            return $res;
        }
    }

    /**
     * 批量解析
     * @param string $mdDir     markdown文件目录
     * @param string $htmlDir   生成的html文件目录
     * @param int $startNo      开始序号
     * @return string
     */
    public static function multiParse($mdDir='',$htmlDir='',$startNo=1)
    {
        // 编码转换为utf-8
        $md_dir = iconv("gb2312","utf-8",$mdDir);
        // 扫描文件
        $list = scandir($md_dir);
        $arr = [ '.', '..'];

        // 定义生成文件导航列表存储变量
        $createIndex = "";
        // 生成文件名开始序号
        $i = $startNo;
        foreach ($list as $v) {
            if (!in_array($v, $arr)) {
                if (!is_dir($v)) {
                    $filename = $i;
                    if ($i < 10) {
                        $filename = '0'.$i;
                    } elseif ($i < 100) {
                        $filename = '00'.$i;
                    }
                    $html = self::handle(file_get_contents($v));

                    $file = rtrim($htmlDir, '/').'/'.$filename.'.html';
                    if (file_exists($file)) unlink($file);
                    file_put_contents($file, $html);

                    $createIndex .= self::createList($file, $v);
                }
            }
        }

        // 生成列表index.html文件
        $list = self::createIndex($createIndex);
        $file = rtrim($htmlDir, '/').'index.html';
        if (file_exists($file)) unlink($file);
        file_put_contents($file, $list);

        return 'finish';
    }

    /**
     * 拼接导航所有内容
     * @param $createIndex
     * @return string
     */
    private static function createIndex($createIndex)
    {
        $title = static::$title;
        // html顶部
        $html_top = <<<EOT
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fooddrug api document</title>
</head>
<body>
	<h1>{$title}</h1>
    <ul>

EOT;

        // html底部
        $html_bottom = <<<EOT
    
    </ul>

</body>
</html>
EOT;

        $index = $html_top.$createIndex.$html_bottom;

        return $index;
    }

    /**
     * 拼装导航list
     * @param $file
     * @param $title
     * @return string
     */
    private static function createList($file, $title)
    {
        $html_main = <<<EOT
    
    <li>
        <a href="./{$file}">{$title}</a>
    </li>

EOT;
        ;
        return $html_main;
    }

    /**
     * 解析后文件拼接
     * @param string $main
     * @return string
     */
    private static function handle($main = '')
    {
        $md = '';
        $md .= static::createMdHeader();
        $md .= $main;
        $md .= static::createMdFooter();

        return $md;
    }

    /**
     * 解析后文件的头部
     * @return string
     */
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

    /**
     * 解析后文件的底部
     * @return string
     */
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
