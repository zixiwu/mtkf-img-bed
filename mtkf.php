<?php
// 目标 URL
$target_url = 'https://kf.dianping.com/api/file/singleImage';

// 如果接收到文件
if(isset($_FILES['file'])) {
    // 获取文件信息
    $file = $_FILES['file'];
    $headers = array(
        'Referer: https://h5.dianping.com/',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0',
    );
    // 准备 POST 数据
    $post_data = array(
        'channel' => '4',
        'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name'])
    );

    // 初始化 cURL
    $curl = curl_init();

    // 设置 cURL 选项
    curl_setopt($curl, CURLOPT_URL, $target_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // 执行请求并获取响应
    $response = curl_exec($curl);

    // 检查是否有错误发生
    if($response === false) {
        echo 'cURL 错误：' . curl_error($curl);
    } else {
        echo $response;
    }

    // 关闭 cURL 资源
    curl_close($curl);
} else {
    echo "未收到文件！";
}
?>
