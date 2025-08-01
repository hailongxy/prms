<?php
// 获取请求的路径（去掉查询字符串）
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 拼接文件路径（基于当前项目根目录）
$basePath = __DIR__;
$filePath = realpath($basePath . $requestUri);

// 安全检查：文件必须存在且在项目根目录中
if (!$filePath || strpos($filePath, $basePath) !== 0 || !is_file($filePath)) {
    http_response_code(404);
    echo "404 Not Found: " . htmlspecialchars($requestUri);
    exit;
}

// 获取文件扩展名
$ext = pathinfo($filePath, PATHINFO_EXTENSION);

// 设置合适的 Content-Type
$mimeTypes = [
    'css'  => 'text/css',
    'js'   => 'application/javascript',
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'svg'  => 'image/svg+xml',
    'woff' => 'font/woff',
    'woff2'=> 'font/woff2',
    'ttf'  => 'font/ttf',
    'eot'  => 'application/vnd.ms-fontobject',
    'html' => 'text/html',
    'txt' => 'text/plain',
];

if (isset($mimeTypes[$ext])) {
    $contentType = $mimeTypes[$ext];
    header("Content-Type: $contentType");
    header("Cache-Control: public, max-age=31536000");
    readfile($filePath);
    exit;
}

// fallback: 交由 Laravel 处理
require __DIR__ . '/public/index.php';