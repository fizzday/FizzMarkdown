# FizzBinary
a binary tree with php (公排22复制php二叉树算法)

## installation (安装)
- 直接使用composer命令  
```
composer require fizzday/fizzbinary
```
- 或者写入composer.json
```
{
    "require": {
        "fizzday/fizzbinary": "dev-master"
    }
}
```
## usage samples (使用示例)
### 示例
```
1
2         3
4   5     6     7
8 9 10 11 12 13 14 15
0: 1;
1: (2^0) ~ (2^1)
2: (2^1) ~ (2^2)
3: (2^2) ~ (2^3)
```
### 1. getLayers($id)
```
use Fizzday\FizzBinary\FizzBinary;

$id = 19;
$res = FizzBinary::getLayers($id);
print_r($res);
```
result (返回第几层)
```
5
```

> param comment (参数说明)  

- `$id` 编号  

variable field (变量字段)
```
id: 编号
```
### 2. getPids($id, $layers=0)
```
use Fizzday\FizzBinary\FizzBinary;

$id = 19;
$res = FizzBinary::getPids($id);
print_r($res);
```
result (匹配结果)
```
Array
(
    [0] => 9
    [1] => 4
    [2] => 2
    [3] => 1
)
```

> param comment (参数说明)  

- `$id` 编号  
- `$layers` 限定层数

return field (返回字段)
```
返回上层人的编号
```
