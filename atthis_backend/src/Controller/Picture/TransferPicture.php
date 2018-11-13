<?php

namespace Controller\Picture;

class TransferPicture
{
    public static function transfer($pictureStr, $index){
        $data = explode( ',', $pictureStr );

        $fileName = date('YmdGisu').'.jpeg';
        $output_file = __DIR__ . "/../../../uploads/" . $index . $fileName;

        $ifp = fopen( $output_file, 'wb' );

        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp );

        return $index . $fileName;
    }
}