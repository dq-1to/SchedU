# SchedU

**SchedU** は、「チャットのように予定を作れる」  
SNSライクなスケジュール管理アプリです。  
自然な会話UIで予定を登録・確認できる体験を目指しています。

---

## Features

- チャット形式での予定登録／編集／削除  
- カレンダー表示（FullCalendar連携）  
- ログイン・ユーザー認証（Laravel Breeze）  
- イベント作成時に「チャットから作成」かを判別  
- 開発用DB管理ツール：**phpMyAdmin** に変更（旧Adminerから移行）

---

## Tech Stack

| カテゴリ | 使用技術 |
|-----------|-----------|
| フレームワーク | Laravel 12.x (PHP 8.3) |
| フロントエンド | Vite / JavaScript / Tailwind CSS |
| データベース | MySQL 8.4 |
| 開発環境 | Docker / Docker Compose |
| 認証 | Laravel Breeze |
| カレンダー | FullCalendar |
| 管理ツール | phpMyAdmin |

---

## 開発環境構成（Docker）

| サービス名 | 役割 | イメージ |
|-------------|------|----------|
| `web` | Nginx（リバースプロキシ） | nginx:1.27-alpine |
| `php` | Laravel実行環境 | my-php:8.3-fpm |
| `db` | MySQLデータベース | mysql:8.4 |
| `phpmyadmin` | DB管理ツール | phpmyadmin:latest |

### 起動コマンド

```bash
docker compose up -d
```

---

## 開発URL

 - アプリ本体: http://localhost
 - phpMyAdmin: http://localhost:8081
 -- ユーザー: root
 -- パスワード: root

---

## Setup

# 依存関係インストール
```bash
composer install
npm install
```

# 環境ファイル設定
```bash
cp .env.example .env
```

# アプリキー生成
```bash
php artisan key:generate
```

# DBマイグレーション
```bash
php artisan migrate
```

# Viteビルド
```bash
npm run build
```

---

## Commit Log

MySQLのGUI管理ツールをAdminerからphpMyAdminに変更
Viteによるフロントビルド環境を構築


## License

This project is open-sourced software licensed under the MIT license.
