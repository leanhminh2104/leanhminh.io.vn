# LeAnhMinh Profile

Website profile cá nhân của Lê Văn Anh Minh.

## Cấu trúc

```text
.
├── index.php              # V1 - chạy local với assets local
├── info/
│   └── index.php          # V1 - trang info dùng assets local
├── assets/                # CSS, JS, hình ảnh, video, nhạc local
└── v2/
    ├── index.php          # V2 - bản dùng CDN GitHub/jsDelivr
    └── info/
        └── index.php      # V2 - trang info dùng CDN GitHub/jsDelivr
```

## V1 - bản local

Dùng khi chạy đầy đủ source trên hosting hoặc localhost.

Cần upload/chạy cả:

```text
index.php
info/index.php
assets/
```

## V2 - bản CDN

Dùng khi muốn hosting nhẹ, chỉ upload file PHP còn assets lấy từ GitHub/jsDelivr.

Khi deploy, copy:

```text
v2/index.php      -> public_html/index.php
v2/info/index.php -> public_html/info/index.php
```

Assets được load từ CDN:

```text
https://cdn.jsdelivr.net/gh/leanhminh2104/leanhminh.io.vn@main/assets/...
```

## Music

- V1 có thể dùng API local tại `assets/music/api.php`.
- V2 dùng danh sách nhạc tĩnh tại `assets/music/tracks.json` qua CDN.

## Ghi chú

Nếu cập nhật file trong `assets/` mà dùng CDN, có thể cần đổi query version hoặc chờ jsDelivr cache cập nhật.
