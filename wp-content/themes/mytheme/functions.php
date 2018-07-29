<?php
add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );
add_action('init', 'register_post_type_and_taxonomy');

/**
 * Register taxonomies
 * @see https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_post_type
 */
function register_post_type_and_taxonomy()
{
    register_post_type(
        'news',
        [
            'labels' => [
                'name' => 'ニュース',
                'add_new_item' => 'ニュースを新規追加',
                'edit_item' => 'ニュースの編集',
            ],
            'menu_icon' => 'dashicons-megaphone',
            'public' => true,
            'hierarchical' => true,
            'has_archive' => true,
            'supports' => [
                'title',
                'editor',
                'thumbnail',
                'author',
            ],
            'menu_position' => 5, // ダッシュボードで投稿の下に表示
            'rewrite' => array('with_front' => false), // パーマリンクの編集（newsの前の階層URLを消して表示）
        ]
    );
}

/**
 * Page nation
 * @param string $pages
 * @param int $range
 */
function pagination($pages = '', $range = 2)
{
    $itemsCount = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;//デフォルトのページ

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;//全ページ数を取得
        if (!$pages)//全ページ数が空の場合は、１とする
        {
            $pages = 1;
        }
    }

    if (1 != $pages)//全ページが１でない場合はページネーションを表示する
    {
        echo "<div class=\"pagenation\">\n";
        echo "<ul>\n";
        //Prev：現在のページ値が１より大きい場合は表示
        if ($paged > 1) echo "<li class=\"prev\"><a href='" . get_pagenum_link($paged - 1) . "'>Prev</a></li>\n";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $itemsCount)) {
                //三項演算子での条件分岐
                echo ($paged == $i) ? "<li class=\"active\">" . $i . "</li>\n" : "<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>\n";
            }
        }
        //Next：総ページ数より現在のページ値が小さい場合は表示
        if ($paged < $pages) echo "<li class=\"next\"><a href=\"" . get_pagenum_link($paged + 1) . "\">Next</a></li>\n";
        echo "</ul>\n";
        echo "</div>\n";
    }
}

/**
 * Newsを取得する
 */
function news_posts()
{
    global $paged;
    query_posts([
        'posts_per_page' => 2,
        'post_type' => 'news',
        'paged' => $paged,
    ]);
}
