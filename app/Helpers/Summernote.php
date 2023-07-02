<?php

namespace App\Helpers;

class Summernote
{
    public static function ImgUpload($data)
    {
        $content = $data;
        $dom = new \DomDocument();
        @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (substr($data, 0, 4) != "http") {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name = time() . $item . '.png';
                $path = public_path('uploads/images') . '/' . $image_name;
                file_put_contents($path, $imgeData);
                $image->removeAttribute('src');
                $image->setAttribute('src', url('uploads/images') . '/' . $image_name);
            }
        }

        return $dom->saveHTML();
    }
}
