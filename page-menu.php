<?php
/*
Template Name:Horizontal scroll page
*/
__('Horizontal scroll page', 'tcd-horizon');
?>
<?php
get_header();
$options = get_design_plus_option();
?>
<div class="page_menu">
    <h2 class="page_menu_heading">MENU</h2>
    <div class="page_menu_inner">
        <div class="page_menu_wrap">
            <div class="page_menu_content">
                <table>
                    <tbody>
                        <h3 class="menu_name">クラフトジン</h3>
                        <?php
                        $array = array(
                            'post_type' => 'craft_gin',
                        );
                        $craft_gin = new WP_Query($array);
                        ?>
                        <?php if ($craft_gin->have_posts()) : ?>
                        <?php while ($craft_gin->have_posts()) : $craft_gin->the_post(); ?>
                        <tr>
                            <td class="page_menu_title"><?php the_field('name'); ?></td>
                            <td class="page_menu_price"><?php the_field('price'); ?>JPY</td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; wp_reset_postdata(); ?>
                    </tbody>
                </table>
            </div>
            <div class="page_menu_content">
                <table>
                    <tbody>
                        <tr>
                            <th class="page_menu_list">ウィスキー</th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ウィスキー銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page_menu_wrap">
            <div class="page_menu_content">
                <table>
                    <tbody>
                        <tr>
                            <th class="page_menu_list">ビール</th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ビール銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="page_menu_content">
                <table>
                    <tbody>
                        <tr>
                            <th class="page_menu_list">ワイン</th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">800JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                        <tr>
                            <th class="page_menu_list"></th>
                            <td class="page_menu_title">ワイン銘柄</td>
                            <td class="page_menu_price">1000JPY</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END #wide_contents -->