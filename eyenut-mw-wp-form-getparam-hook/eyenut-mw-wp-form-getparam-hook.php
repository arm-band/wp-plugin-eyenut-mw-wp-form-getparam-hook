<?php
/*
Plugin Name: アイナット (MW WP Form GETパラメータ フック)
Description: MW WP Form にアクセスした際、 <GETパラメータ に articleキー のパラメータが存在する場合に該当記事IDの記事タイトルを自動入力するプラグイン。該当フォームに <!-- 記事ID --> のコメント入力が必要。
Version:     0.0.1
Author:      アルム＝バンド
*/

function eyenut_mwform_autocomplete_getparam_tag( $content, $Data ) {
    if( ! empty( esc_attr( $_GET['article'] ) ) ) {
        $str = "記事:
                  <input readonly type=\"text\" name=\"article\" id=\"article\" class=\"article\" value=\"" . get_the_title( esc_attr( $_GET['article'] ) ) . "\">";
        $content = str_replace( '<!-- 記事ID -->', $str, $content );
    }
    else {
        $content = str_replace( '<!-- 記事ID -->', '', $content );
    }
    return $content;
}
/**
 * アクションフック
 *
 * `mwform_post_content_mw-wp-form-xxx` はフックで使用する修飾子。 `xxx`はフォーム識別子として作成したフォームの投稿IDとする
 * ※今回はサンプルなので投稿IDはハードコーディング
 */
add_filter('mwform_post_content_mw-wp-form-xxx', 'eyenut_mwform_autocomplete_getparam_tag', 10, 2);
