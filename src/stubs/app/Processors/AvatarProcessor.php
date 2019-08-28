<?php


namespace App\Processors;


class AvatarProcessor {
    public static function get( $model ) {
        if (empty($model->file)) {
            if (!empty($model->name)) {
                return 'https://avatars.dicebear.com/v2/initials/' . preg_replace('/[^a-z0-9 _.-]+/i', '', $model->name) . '.svg';
            }

            return null;
        }

        return $model->file->url;
    }
}
