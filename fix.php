<?php
function logs($msg) {
    static $i;
    $i++;
    $msg = iconv('utf-8', 'gb2312', $msg);
    echo "[$i]" . $msg . PHP_EOL;
}

$file = 'fix.txt';
$file2 = 'missing.txt';
logs('程序开始运行...');
do {
    if (file_exists($file)) {
        unlink($file);
    }
    exec("npm run serve 2>{$file}");
    logs('编译异常，正在尝试安装package...');
    if (!file_exists($file)) {
        break;
    }
    $content = file_get_contents($file);
    if (empty(trim($content))) {
        break;
    }
    preg_match("/Cannot\s+find\s+module\s+\'([^\']+)\'/", $content, $match);
    if (!empty($match) && isset($match[1])) {
        $missing = $match[1];
        if (strpos($missing, '/') !== false) {
            $arr = explode('/', $missing);
            $missing = $arr[0];
        }
        logs("开始安装<{$missing}>...");
        exec("npm install -g {$missing} 2>{$file2}");
        logs("<{$missing}>安装完毕...");
    } else {
        logs('遇到未知错误，请手动处理');
        break;
    }
} while (file_exists($file));
if (file_exists($file)) {
	unlink($file);
}
if (file_exists($file2)) {
	unlink($file2);
}
logs('检测通过，编译完成');