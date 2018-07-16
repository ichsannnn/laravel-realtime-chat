# SELV Realtime Chat
SELV (akronim dari Socket.io, Echo, Laravel, dan Vue) adalah aplikasi realtime chat dengan VueJs sebagai client-side dan Laravel sebagai server-side. Memadukan [Socket.io](https://github.com/socketio/socket.io) dan [Laravel Echo](https://github.com/tlaverdure/laravel-echo-server).
#### Incoming Features
* General chat
* Private chat ( WIP )
* Team chat ( WIP )

## Installation
* Clone project
```bash
$ git clone https://github.com/skadevz/laravel-realtime-chat.git realtime-chat
```
* Masuk ke direktori project melalui terminal, dan install library yang diperlukan
```bash
$ cd realtime-chat
$ composer install
$ npm install
```
* Buat file environment baru dan ubah sesuai dengan sistem yang digunakan
```bash
$ cp .env.example .env
$ php artisan key:generate
```
* Lakukan [init](https://github.com/tlaverdure/laravel-echo-server#initialize-with-cli-tool) laravel-echo
* Migrate database
* Jalankan laravel-echo
```bash
$ laravel-echo-server start
```
* Untuk menjalankan laravel-echo pada background process, bisa menggunakan [Supervisor](https://laravel.com/docs/5.6/queues#supervisor-configuration)
