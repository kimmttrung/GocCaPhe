# Website Quán Góc Cafe ☕

<details>
<summary><strong>Tiếng Việt</strong></summary>

> Hệ thống quản lý và kinh doanh quán Cafe trực tuyến 
> Hỗ trợ khách hàng đặt bàn, đặt món và giúp quản trị viên điều hành nhân sự, thực đơn chuyên nghiệp.

## 📚 Mục lục
<summary>📖 Bấm để xem</summary>

-  [🔗 Đường dẫn](#links-vi)
- [🚀 Giới thiệu](#overview)
- [✨ Tính năng chính](#features)
- [🛠 Công nghệ sử dụng](#tech)
- [📸 Ảnh / GIF demo](#demo)
- [⚙️ Cài đặt & Chạy dự án](#install)
- [📂 Cấu trúc thư mục](#structure)
-  [🚀 Cải tiến trong tương lai](#future-vi)


## 🔗 Đường dẫn <a id="links-vi"></a>

-   Video demo: [YouTube](https://www.youtube.com/watch?v=oxVCXuJaLV4&t=4s)

## 🚀 Giới thiệu <a id="overview"></a>

Dự án Website Quán Góc Cafe là nền tảng hỗ trợ kinh doanh và phục vụ khách hàng hiệu quả, giúp bạn:
- Cung cấp đầy đủ thông tin về không gian và dịch vụ của quán.
- Cho phép khách hàng xem menu đồ uống và món ăn dễ dàng.
- Hỗ trợ đặt bàn và đặt món trực tuyến để nâng cao trải nghiệm người dùng.
- Tối ưu hóa công tác quản lý tài khoản, nhân viên và lịch làm việc.

## ✨ Tính năng chính <a id="features"></a>
### 1️⃣ Dành cho Khách hàng (User)

- **Xem trang chủ**: Truy cập thông tin giới thiệu, không gian và khuyến mãi.
- **Đặt bàn Online**: Đăng ký giữ chỗ trước kèm số lượng người và ghi chú.
- **Đặt món & Thanh toán**: Chọn món vào giỏ hàng, cập nhật số lượng và thực hiện thanh toán.

### 2️⃣ Dành cho Nhân viên (Staff)

- **Xử lý đơn hàng**: Tiếp nhận, kiểm tra và xác nhận các đơn hàng từ khách.
- **Quản lý đặt bàn**: Kiểm tra tình trạng bàn trống để duyệt hoặc từ chối yêu cầu đặt chỗ.
- **Chấm công & Lương**: heo dõi lịch làm việc và kiểm tra thu nhập dự kiến.

### 3️⃣ Dành cho Quản trị viên (Admin)

- Quản lý Menu: Thêm, sửa, xóa danh mục và các sản phẩm món ăn/đồ uống.
- Quản trị nhân sự: Phân quyền tài khoản, sắp xếp ca trực (Sáng/Chiều/Tối) cho nhân viên.
- Thống kê & Báo cáo: Tổng hợp dữ liệu kinh doanh và xuất báo cáo ra file Excel.

## 🛠 Công nghệ sử dụng <a id="tech"></a>

| Phần     | Công nghệ / Thư viện                  |
| -------- | ------------------------------------- |
| Frontend | HTML5 + CSS3 + JavaScript + Bootstrap |
| Backend  | PHP (v8.x) + Framework Laravel        |
| Database | MySQL (MariaDB)                       |
| Server   | XAMPP Local Server                    |
| IDE      | Visual Studio Code                    |

---

## 📸 Ảnh / GIF demo <a id="demo"></a>

<div align="center">

![Giới thiệu](./GocCaPhe/public/images/HomePage.png)
![Trang chủ](./00-fontend-react_mindmap/public/images/Dashboard.png)
![Tạo nội dung từ AI](./00-fontend-react_mindmap/public/images/Flashcard.png)
![Tạo nội dung từ AI](./00-fontend-react_mindmap/public/images/CreateWithAI.png)
![Flashcard & Quiz](./00-fontend-react_mindmap/public/images/FlashcardQuiz.png)
![Flashcard & Quiz](./00-fontend-react_mindmap/public/images/Dícussion.png)
![Discusion](./00-fontend-react_mindmap/public/images/FlashcardQuiz.png)
![Add Fiends](./00-fontend-react_mindmap//public/images/AddFriend.png)
![Chat](./00-fontend-react_mindmap//public/images/Chat.png)
![Chat](./00-fontend-react_mindmap//public/images/Leaderboard.png)
![Chat](./00-fontend-react_mindmap//public/images/Setting.png)

</div>

---

## ⚙️ Cài đặt & Chạy dự án <a id="install"></a>

### Yêu cầu

- PHP v8.x trở lên
- XAMPP (bao gồm Apache và MySQL) 
- Composer (để quản lý các gói Laravel)

### Bước cài đặt (Development)

```Bash

# 1. Clone project
git clone https://github.com/kimmttrung/GocCaPhe

# 2. Cài đặt các thư viện PHP
composer install

# 3. Cấu hình file .env
cp .env.example .env
# Chỉnh sửa thông số DATABASE_URL phù hợp với MySQL của bạn

# 4. Tạo khóa ứng dụng Laravel
php artisan key:generate

# 5. Khởi chạy Server
php artisan serve
```


## 📂 Cấu trúc thư mục <a id="structure"></a>
```bash
GocCafe_Website/
│── app/            # Chứa Controllers và Models (Logic xử lý nghiệp vụ) [cite: 401,403]
│── bootstrap/      # File cấu hình khởi động framework
│── config/         # Các file cấu hình hệ thống (DB, App, Auth...)
│── database/       # Chứa Migrations (Cấu trúc 8 bảng database) [cite: 517]
│── public/         # Chứa tài nguyên tĩnh (Images, CSS, JS) [cite: 407]
│── resources/
│   ├── views/      # Chứa các file giao diện (.blade.php) [cite: 402]
│── routes/         # Định nghĩa các đường dẫn web (Web routes)
│── storage/        # Lưu trữ file log và báo cáo Excel xuất ra [cite: 491]
│── .env            # Config biến môi trường và kết nối DB
│── package.json    # Quản lý các dependencies frontend
```

## 🚀 Cải tiến trong tương lai <a id="future-vi"></a>
- **Tích hợp thanh toán QR**: Hỗ trợ khách hàng thanh toán nhanh qua MoMo, VNPay.
- **Hệ thống thành viên**: Xây dựng chương trình tích điểm và ưu đãi cá nhân hóa cho khách hàng.
- **Thông báo thời gian thực**: Gửi thông báo ngay lập tức cho nhân viên khi có đơn hàng hoặc lịch đặt bàn mới.
- **Phân tích doanh thu**: Biểu đồ hóa dữ liệu kinh doanh hàng tháng để Admin dễ dàng theo dõi tiến độ.
- **Đa ngôn ngữ**: Hỗ trợ giao diện tiếng Anh và tiếng Nhật để mở rộng đối tượng khách hàng quốc tế. 
</details>

<details>
<summary><strong>日本語</strong></summary>


> スマート学習プラットフォーム：AIによるフラッシュカード・クイズ・マインドマップ生成（Text / PDF / DOC / Image 対応）
> 学習モード・復習モード・試験モード・ゲーム・フレンド機能・Q&Aコミュニティ・バッジ/報酬システムを搭載。

## 📚 目次
<summary>📖 クリックして表示</summary>

-  [🔗 リンク](#link1)
- [🚀 概要](#link2)
- [✨ 主な機能](#link3)
- [🛠 使用技術](#link4)
- [📸 デモ画像 / GIF](#link5)
- [⚙️ インストール & プロジェクト実行方法](#link6)
- [📂 ディレクトリ構成](#link7)
- [🚀 今後の改善予定](#link8)


## 🔗 リンク <a id="link1"></a>

-  デモ動画: [YouTube](https://www.youtube.com/watch?v=oxVCXuJaLV4&t=4s)

## 🚀 概要 <a id="link2"></a>

Hackathon2025_StudyMate は、効率的な学習をサポートするプラットフォームです。

- テキストやファイルから フラッシュカード・クイズ・マインドマップ を即生成
- 間隔反復（spaced repetition）による復習機能
- 模擬試験・学習ゲームモード
- フレンドとつながり、資料を共有
- 多分野の学習コミュニティに参加可能

## ✨ 主な機能 <a id="link3"></a>
### 1️⃣ AIによる学習コンテンツ生成

- テキスト入力 または PDF / DOC / 画像をアップロード 
- AIが マインドマップ・フラッシュカード・クイズ を自動生成
- 難易度や問題数のカスタマイズ可能

### 2️⃣ 学習・復習・テスト・ゲームモード

- **Study Mode**: フラッシュカードで学習 & 賢い復習スケジュール
- **Review Mode**: クイズを解いて即フィードバック 
- **Exam Mode**: タイマー付き模擬試験
- **Games**: マッチング・早押し・ランキングバトル

### 3️⃣ インタラクティブ・マインドマップ

- AIが生成した思考マップを表示
- ドラッグ操作で編集可能・画像 / PDFでエクスポート

### 4️⃣ コミュニティ & フレンド機能

- ユーザー同士のつながり・チャット・資料共有
- Q&A掲示板・コメント・いいね・評価機能
- 貢献ユーザー向けバッジ・ランキング

## 🛠 使用技術 <a id="link4"></a>

| パート   | 技術 / ライブラリ                      |
| -------- | -------------------------------------- |
| Frontend | React + Vite + TailwindCSS + shadcn/ui |
| Backend  | Node.js 20 / 22, Express, Socket.IO    |
| Database | PostgreSQL + Drizzle ORM               |
| Cloud    | Cloudinary                             |
| AI       | Google Gemini API                      |
| Auth     | JWT                                    |

---

## 📸 デモ画像 / GIF <a id="link5"></a>

<div align="center">

![Giới thiệu](./00-fontend-react_mindmap/public/images/HomePage.png)
![Trang chủ](./00-fontend-react_mindmap/public/images/Dashboard.png)
![Tạo nội dung từ AI](./00-fontend-react_mindmap/public/images/Flashcard.png)
![Tạo nội dung từ AI](./00-fontend-react_mindmap/public/images/CreateWithAI.png)
![Flashcard & Quiz](./00-fontend-react_mindmap/public/images/FlashcardQuiz.png)
![Flashcard & Quiz](./00-fontend-react_mindmap/public/images/Dícussion.png)
![Discusion](./00-fontend-react_mindmap/public/images/FlashcardQuiz.png)
![Add Fiends](./00-fontend-react_mindmap//public/images/AddFriend.png)
![Chat](./00-fontend-react_mindmap//public/images/Chat.png)
![Chat](./00-fontend-react_mindmap//public/images/Leaderboard.png)
![Chat](./00-fontend-react_mindmap//public/images/Setting.png)

</div>

---

## ⚙️ インストール & プロジェクト実行方法 <a id="link6"></a>

### 必要環境

- Node.js v20.14.0 or v22.14.0  
- PostgreSQL 14+  
- React 19
- Cloudinary account  
- Google Gemini API key  

### セットアップ手順（開発環境）

```bash
# 1. プロジェクトをクローン
git clone https://github.com/kimmttrung/Hackathon2025_StudyMate.git

# 2. ライブラリをインストール
cd 00 （Tabキー → Enter）
npm i
cd 01 （Tabキー → Enter）
npm i

# 3. .env ファイルを設定
cp .env.example -> .env
# DATABASE_URL, CLOUDINARY, GEMINI_API_KEY などを編集

# 4. プロジェクトを起動
npm start

```

## 📂 ディレクトリ構成 <a id="link7"></a>
```bash
00-frontend-react-mindmap/
│── public/ # Static files (ảnh, favicon, ...)
│── src/
│ ├── components/ # Các component tái sử dụng
│ ├── data/ # Dữ liệu tĩnh hoặc mock data
│ ├── hooks/ # Custom React hooks
│ ├── pages/ # Các page chính của ứng dụng
│ ├── styles/ # File CSS/Tailwind tuỳ chỉnh
│ ├── utils/ # Hàm tiện ích (helper functions)
│ ├── App.jsx # Component gốc
│ ├── main.jsx # Entry point, render React
│ └── Routes.jsx # Định nghĩa routes
│
│── .env # Config biến môi trường (FE)
│── index.html # Entry HTML
│── package.json # Quản lý dependencies
│── tailwind.config.js # Cấu hình TailwindCSS
│── vite.config.js # Cấu hình Vite

01-backend-nodejs-postgres/
│── src/
│ ├── config/ # Cấu hình DB, env, ...
│ ├── controllers/ # Xử lý logic request/response
│ ├── middleware/ # Middleware (auth, validate, ...)
│ ├── models/ # Định nghĩa model kết nối DB
│ ├── routes/ # Định nghĩa API routes
│ ├── services/ # Business logic/service layer
│ ├── temp/ # Thư mục tạm
│ ├── utils/ # Hàm tiện ích
│ ├── views/ # Template/view (nếu có)
│ └── server.js # Entry point khởi động server
│
│── uploads/ # Lưu file upload
│── .env # Config biến môi trường (BE)
│── package.json # Quản lý dependencies
```

## 🚀 今後の改善予定 <a id="link8"></a>
- AIによる学習プランのパーソナライズ：各ユーザーの能力と進捗に応じた資料・クイズ・フラッシュカードを自動提案。  
- 音声認識 & 発音採点機能：IELTS／TOEIC／その他言語学習向けのスピーキング練習をサポート。
- 高度なゲーミフィケーション：デイリーミッション、経験値（XP）システム、バーチャルアイテム、チーム対抗イベントを追加。
- 多様な情報ソースとの連携：Google Drive・Notion・GitHub・Wikipedia から自動で学習コンテンツを生成。
- モバイルアプリ（iOS / Android）対応：Web版と同期し、いつでもどこでも学習可能。
- オンライン協力モード：複数人でリアルタイムにクイズやゲームに参加。
- 学習データ分析：進捗グラフ、スコア予測、弱点スキルの改善提案。
- 多言語対応：ベトナム語・英語・日本語・韓国語など、国際コミュニティに向けて拡張。

</details>
<!-- <details>
<summary><strong>English</strong></summary>
</details> -->
