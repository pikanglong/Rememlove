# BrainHole
A repository for NJUPT mind-blowing programming week

### 安装指南

Here is detailed step about deploying 记恋:

1. You need to have a server and installed [PHP](http://php.net/downloads.php) and [Composer](https://getcomposer.org);

2. Clone ContestEase to your website folder;

3. Change your website root to `public` folder and then, if there is a `open_basedir` restriction, remove it;

4. Now run the following commands at the root folder of 记恋;

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
```

8. 记恋's up-and-running, enjoy!

### 需求分析

- 菜单
    - 显示功能
- 回忆宝箱
    - 记录平时出游的照片
    - 记录悄悄话
    - 允许设定过多长时间之后才允许查看
    - 允许设定把某些记录通过短链分享给他人查看
    - 允许给记录设定密码、提示等
- 恋爱打卡
    - 每天一个打卡目标(选项)
        - 自定义打卡目标
        - 每天随机一个打卡目标
    - 上传一张图片完成打卡
    - 每条打卡的记录允许通过短链分享
    - 允许把打卡的记录存入回忆宝箱
- 用户绑定
    - 每两个用户关系之间可以形成绑定关系(具体可以再琢磨一下
    - 可以选择单身(？
- 恋爱日常
    - 允许绑定关系之间的任意一方提出问题或者其他的东西，然后另外一方满足(?
    - ~~允许双方来一场辩论赛?!~~
    - 允许把恋爱日常存入回忆宝箱
    - 同样允许短链分享
