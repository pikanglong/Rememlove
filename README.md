# Rememlove（记恋）
这是南京邮电大学2019脑洞程序设计大赛的一个比赛作品。竞赛的规则[点击这里](https://mp.weixin.qq.com/s/uNcCmo8hhJMujPMb8zF9Aw)可以查看。在这里要感谢[高凡](https://github.com/goufaan)和[曹轶峰](https://github.com/X3ZvaWQ)同学。高凡同学在UI方面做出了杰出的贡献，曹轶峰同学的代码逻辑严谨、清晰易读，在演示时起到了很不错的效果。

### 安装指南

Here is detailed step about deploying Rememlove:

1. You need to have a server and installed [PHP](http://php.net/downloads.php) and [Composer](https://getcomposer.org);

2. Clone Rememlove to your website folder;

3. Change your website root to `public` folder and then, if there is a `open_basedir` restriction, remove it;

4. Now run the following commands at the root folder of Rememlove;

```
composer install
```

> Notice: you may find this step(or others) fails with message like "func() has been disabled for security reasons", it means you need to remove restrictions on those functions, basically Laravel and Composer require proc_open and proc_get_status to work properly.

5. Almost done, you still got to modify a few folders and give them permission to write;

```
chmod -R 775 storage/
chmod -R 775 bootstrap/
```

6. OK, right now we still need to configure environment, a typical `.env` just like the `.env.example`, you simply need to type the following codes;

```
cp .env.example .env
vim .env
```

7. Now, we need to configure the database, thankfully Laravel have migration already;

```
php artisan migrate
php artisan storage:link
```

8. Rememlove's up-and-running, enjoy!

### 基本功能

- [X] 【菜单】用以显示并作为全部功能的入口；
- [X] 【回忆宝箱】记录你们外出游玩的照片，平时的悄悄话，都可以写进回忆宝箱，等到以后翻开来看，每一天都是满满的回忆哦； 
- [X] 【恋爱打卡】设置每日打卡小目标，每天完成了可以打卡。

### 需求分析

- [X] 菜单
    - [X] 显示功能
- [X] 回忆宝箱
    - [X] 记录平时出游的照片
    - [X] 记录悄悄话
    - [X] 允许设定过多长时间之后才允许查看
    - [X] 允许设定把某些记录通过短链分享给他人查看
    - [X] 允许给记录设定密码、提示等
- [ ] 恋爱打卡
    - [X] 每天一个打卡目标(选项)
        - [X] 自定义打卡目标
        - [X] 每天随机一个打卡目标
    - [X] 上传一张图片完成打卡
    - [ ] 每条打卡的记录允许通过短链分享
    - [ ] 允许把打卡的记录存入回忆宝箱
- [X] 用户绑定
    - [X] 每两个用户关系之间可以形成绑定关系(具体可以再琢磨一下
    - [X] 可以选择单身(？
- [ ] 恋爱日常
    - [ ] 允许绑定关系之间的任意一方提出问题或者其他的东西，然后另外一方满足(?
    - [ ] ~~允许双方来一场辩论赛?!~~
    - [ ] 允许把恋爱日常存入回忆宝箱
    - [ ] 同样允许短链分享
