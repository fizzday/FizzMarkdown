# FizzMarkdown
a mardown parser with php(markdown解析器)

## installation (安装)
- 直接使用composer命令  
```
composer require fizzday/fizzmarkdown
```
- 或者写入composer.json
```
{
    "require": {
        "fizzday/fizzmarkdown": "dev-master"
    }
}
```
## usage samples (使用示例)

### 单个文件解析: parse($content, $return_html=false)
```
use Fizzday\FizzMarkdown\FizzMarkdown;

$file = './test.md';
// or
$file = <<<EOT
## markdown test
- mark
- down 
EOT;
$res = FizzMarkdown::parse($file, true);
print_r($res);
```

### 多文件解析