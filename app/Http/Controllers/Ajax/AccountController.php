<?php

namespace App\Http\Controllers\Ajax;

use App\Models\AjaxResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * 更新用户头像.
     *
     * @param Request $request
     * @return Response
     */
    public function updateAvatar(Request $request)
    {
        $path = $request->file('avatar')->store('public/avatars');
        switch (exif_imagetype($path)) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($path);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($path);
                break;
        }
        /* 获取图像尺寸信息 */
        $target_w = 400;
        $target_h = 400;
        $source_w = imagesx($image);
        $source_h = imagesy($image);
        /* 计算裁剪宽度和高度 */
        $judge = (($source_w / $source_h) > ($target_w / $target_h));
        $resize_w = $judge ? ($source_w * $target_h) / $source_h : $target_w;
        $resize_h = !$judge ? ($source_h * $target_w) / $source_w : $target_h;
        $start_x = $judge ? ($resize_w - $target_w) / 2 : 0;
        $start_y = !$judge ? ($resize_h - $target_h) / 2 : 0;
        /* 绘制居中缩放图像 */
        $resize_img = imagecreatetruecolor($resize_w, $resize_h);
        imagecopyresampled($resize_img, $image, 0, 0, 0, 0, $resize_w, $resize_h, $source_w, $source_h);
        $target_img = imagecreatetruecolor($target_w, $target_h);
        imagecopy($target_img, $resize_img, 0, 0, $start_x, $start_y, $resize_w, $resize_h);
        /* 将图片保存至文件 */

        switch (exif_imagetype($path)) {
            case IMAGETYPE_JPEG:
                imagejpeg($target_img, $path);
                break;
            case IMAGETYPE_PNG:
                imagepng($target_img, $path);
                break;
            case IMAGETYPE_GIF:
                imagegif($target_img, $path);
                break;
        }
        $path = substr($path,6);
        Auth::user()->update(['avatar' => 'storage'.$path]);
        return AjaxResponse::success();
    }
}
