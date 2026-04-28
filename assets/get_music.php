<?php
// BẮT BUỘC: Xóa bộ nhớ đệm đầu ra để tránh khoảng trắng hoặc lỗi PHP chèn vào JSON
ob_start();

// Cấu hình Header trả về JSON
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *"); // Cho phép mọi domain truy cập (tránh lỗi CORS)

$url = 'https://api.dichvusale.io.vn/api/music/api-nhac-full/';

// Kiểm tra CURL
if (!function_exists('curl_init')) {
    responseError('Hosting của bạn không hỗ trợ cURL.');
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// --- QUAN TRỌNG: Giả lập trình duyệt ---
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36');
// --- QUAN TRỌNG: Bỏ qua kiểm tra SSL (Fix lỗi hosting không kết nối được https) ---
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// Thời gian chờ 10s
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error_msg = curl_error($ch);
curl_close($ch);

// Xóa sạch bộ đệm trước khi in kết quả
ob_clean(); 

if ($response === false) {
    responseError('Lỗi cURL: ' . $error_msg);
}

if ($httpCode !== 200) {
    responseError('API gốc trả về lỗi HTTP: ' . $httpCode);
}

// Kiểm tra xem kết quả lấy về có phải JSON xịn không
$jsonCheck = json_decode($response);
if ($jsonCheck === null) {
    responseError('Dữ liệu trả về không phải JSON hợp lệ (Có thể API bảo trì).');
}

// IN KẾT QUẢ CHO JAVASCRIPT
echo $response;
exit();

// Hàm trả về lỗi chuẩn JSON
function responseError($msg) {
    ob_clean(); // Xóa sạch rác lần nữa cho chắc
    echo json_encode([
        'error' => true,
        'message' => $msg,
        'musicUrl' => '' // Trả về rỗng để JS check
    ]);
    exit();
}
?>