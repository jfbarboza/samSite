<?php

class TMM_Helper {

    public static $shortcodes_js_links = array();

    //to call shorcodes by ajax
    public static function add_shortcode_js_link($js_link) {
        if (isset($_REQUEST['is_ajax_action'])) {
            if (!in_array($js_link, self::$shortcodes_js_links)) {
                self::$shortcodes_js_links[] = $js_link;
            }
        }
    }

    public static function get_post_featured_image($post_id, $alias, $show_cap = true) {
        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');

        $img_src = $img_src[0];
        $url = self::get_image($img_src, $alias, $show_cap);
        return $url;
    }

    public static function explode_link($url, $onepage_array, $home_url = false) {

        $exp = explode('?', $url);

        if (isset($exp[1])) {
            $str = str_replace('=', '_', $exp[1]);

            if (in_array($str, $onepage_array)) {
                $url = '#' . $str;
                if ($home_url) {

                    $frontpage = get_permalink(TMM::get_option('frontpage'));

                    if (!empty($frontpage)) {
                        return $frontpage . $url;
                    } else {
                        return home_url() . $url;
                    }
                }
            }
        } else {
            if (in_array(TMM_Helper::parseUrl($url), $onepage_array)) {
                $str = TMM_Helper::parseUrl($url);
                $url = '#' . $str;
                if ($home_url) {

                    $frontpage = get_permalink(TMM::get_option('frontpage'));

                    if (!empty($frontpage)) {
                        return $frontpage . $url;
                    } else {
                        return home_url() . $url;
                    }
                }
            }
        }
        return $url;
    }

    public static function parseUrl($string_id) {

        $exp = explode('?', $string_id);

        if (isset($exp[1])) {
            $string = str_replace('=', '_', $exp[1]);
            return $string;
        } else {
            $parse = parse_url($string_id);
            $string = str_replace('/', '', $parse['path']);
            return $string;
        }
    }

    public static function resize_image($img_src, $alias, $show_cap = true) {
        return self::get_image($img_src, $alias, $show_cap);
    }

    public static function get_image($img_src, $alias, $show_cap = true) {

        if (empty($alias)) {
            return $img_src;
        }

        $al = explode('*', $alias);
        $new_img_src = aq_resize($img_src, $al[0], $al[1], true);

        if (!$new_img_src) {
            if ($show_cap) {
                return 'http://placehold.it/' . $al[0] . 'x' . $al[1] . '&text=NO IMAGE';
            }
        }

        return $new_img_src;
    }

    public static function is_file_url_exists($url) {
        $current_dome_count = substr_count($url, home_url());
        if (!$current_dome_count) {
            return FALSE;
        }

        $path_array = explode('wp-content', $url);
        if (file_exists(ABSPATH . 'wp-content' . $path_array[1])) {
            return TRUE;
        }

        return FALSE;
    }

    /*
     * Get type of video (vimeo,youtube) and images of site
     */

    public static function get_media_type($source_url) {
        $media_type = 'image';
        $allows_video_array = array('youtube.com', 'vimeo.com');
        foreach ($allows_video_array as $needle) {
            $count = strpos($source_url, $needle);
            if ($count !== FALSE) {
                $media_type = 'video';
                break;
            }
        }

        return $media_type;
    }

    // Portfolio listing page in one page template
    public static function get_folio_onepage() {

        $folio_page_onepage = TMM::get_option("folio_page_onepage");
        $frontpage = TMM::get_option("frontpage");
        $onepage_id = get_post_meta($frontpage, 'onepage', true);

        if (!empty($frontpage) && !empty($onepage_id)) {
            if (!empty($folio_page_onepage)) {
                $permalink = site_url() . "#" . TMM_Helper::parseUrl(get_permalink($folio_page_onepage));
            } else {
                $permalink = get_post_type_archive_link(TMM_Portfolio::$slug);
            }
        } else {
            $permalink = get_post_type_archive_link(TMM_Portfolio::$slug);
        }

        return $permalink;
    }

    //Custom page navigation
    public static function pagenavi($query = null) {
        global $wp_query, $wp_rewrite;
        if (!$query)
            $query = $wp_query;
        $pages = '';
        $max = $query->max_num_pages;
        if (!$current = get_query_var('paged')) {
            $current = 1;
        }

        $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
        $a['total'] = $max;
        $a['current'] = $current;

        $total = 1; //1 - display the text "Page N of N", 0 - not display
        $a['mid_size'] = 4; //how many links to show on the left and right of the current
        $a['end_size'] = 1; //how many links to show in the beginning and end
        $a['prev_text'] = ''; //text of the "Previous page" link
        $a['next_text'] = ''; //text of the "Next page" link

        echo $pages . paginate_links($a);
    }

    public function add_comment() {
        if (!empty($_REQUEST['comment_content'])) {
            $time = current_time('mysql');
            $user = get_userdata(get_current_user_id());
            $data = array(
                'comment_post_ID' => $_REQUEST['comment_post_ID'],
                'comment_author' => $user->data->user_nicename,
                'comment_author_email' => $user->data->user_email,
                'comment_author_url' => $user->data->user_url,
                'comment_content' => $_REQUEST['comment_content'],
                'comment_parent' => $_REQUEST['comment_parent'],
                'user_id' => $user->data->ID,
                'comment_date' => $time,
            );

            echo wp_insert_comment($data);
        }

        exit;
    }

    public static function get_monts_names($num) {
        $monthes = array(
            0 => __('January', 'accio'),
            1 => __('February', 'accio'),
            2 => __('March', 'accio'),
            3 => __('April', 'accio'),
            4 => __('May', 'accio'),
            5 => __('June', 'accio'),
            6 => __('July', 'accio'),
            7 => __('August', 'accio'),
            8 => __('September', 'accio'),
            9 => __('October', 'accio'),
            10 => __('November', 'accio'),
            11 => __('December', 'accio'),
        );

        return $monthes[$num];
    }

    public static function get_short_monts_names($num) {
        $monthes = array(
            0 => __('jan', 'accio'),
            1 => __('feb', 'accio'),
            2 => __('mar', 'accio'),
            3 => __('apr', 'accio'),
            4 => __('may', 'accio'),
            5 => __('jun', 'accio'),
            6 => __('jul', 'accio'),
            7 => __('aug', 'accio'),
            8 => __('sep', 'accio'),
            9 => __('oct', 'accio'),
            10 => __('nov', 'accio'),
            11 => __('dec', 'accio'),
        );

        return $monthes[$num];
    }

    public static function get_days_of_week($num) {
        $days = array(
            0 => __('Sunday', 'accio'),
            1 => __('Monday', 'accio'),
            2 => __('Tuesday', 'accio'),
            3 => __('Wednesday', 'accio'),
            4 => __('Thursday', 'accio'),
            5 => __('Friday', 'accio'),
            6 => __('Saturday', 'accio'),
        );

        return $days[$num];
    }

    public static function db_quotes_shield($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = self::db_quotes_shield($value);
                } else {
                    $value = stripslashes($value);
                    $value = str_replace('\"', '"', $value);
                    $value = str_replace("\'", "'", $value);
                    $data[$key] = $value;
                }
            }
        }

        return $data;
    }

    public static function get_post_sort_array() {
        return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
            'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
            'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
            'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
            'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
    }

    public static function get_post_categories() {
        $post_categories_objects = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC',
            'style' => 'list',
            'show_count' => 0,
            'hide_empty' => 0,
            'use_desc_for_title' => 1,
            'child_of' => 0,
            'hierarchical' => true,
            'title_li' => '',
            'show_option_none' => '',
            'number' => NULL,
            'echo' => 0,
            'depth' => 0,
            'current_category' => 0,
            'pad_counts' => 0,
            'taxonomy' => 'category',
            'walker' => 'Walker_Category'));

        $post_categories = array();
        $post_categories[0] = __('All Categories', 'accio');
        foreach ($post_categories_objects as $value) {
            $post_categories[$value->term_id] = $value->name;
        }

        return $post_categories;
    }

    public static function display_onepage_video($onepage_id, $onepage_options) {
        ?>
        <?php if ($onepage_id): ?>

            <?php if (isset($onepage_options['bg_video']) AND !empty($onepage_options['bg_video'])): ?>

                <?php switch ($onepage_options['bg_type']):
                    case 'youtube':
                        ?>
                        <a class="player" id="bgndVideo" data-property="{
                           videoURL: '<?php echo $onepage_options['bg_video'] ?>',
                           containment:'body',
                           autoPlay: true,
                           quality: '<?php echo $onepage_options['video_quality'] ?>',
                           mute: true, 
                           startAt: 0,
                           opacity: 1,
                           ratio: '16/9', 
                           addRaster: false }">
                        </a>
                        <?php break; ?>
                    <?php case 'vimeo': ?>
                        <div class="mb-wrapper">
                            <iframe src="<?php echo $onepage_options['bg_video'] ?>?autoplay=1&loop=1&portrait=0&controls=0&showinfo=0&autohide=1&rel=0&wmode=transparent"></iframe>
                        </div><!--/ .mb-wrapper-->
                        <?php break; ?>
                    <?php case 'selfhosted': ?>
                        <video id="example_video" class="video-js vjs-default-skin vjs-fullscreen" width="1280" height="720" >
                            <source src="<?php echo $onepage_options['bg_video'] ?>" type='video/mp4' />
                        </video>
                        <?php break; ?>
                    <?php default: ?>

                        <?php break; ?>
                <?php endswitch; ?>

            <?php endif; ?>

        <?php endif; ?>
        <?php
    }

    public static function draw_breadcrumbs() {
        $standard_breadcrumb = false;
        if (is_single() OR is_page()) {
            $standard_breadcrumb = true;
        }

        if (is_category() OR is_archive()) {
            $standard_breadcrumb = true;
        }

        //***

        if ($standard_breadcrumb) {
            if (!is_home()) {
                global $post;
                echo '<a href="';
                echo home_url();
                echo '">';
                _e("Home", 'accio');
                echo "</a> ";
                if (is_category() || is_single()) {
                    if (is_object($post)) {
                        //$category_list = ThememakersHelper::get_the_category_list(',');
                        $categories = get_the_category($post->ID);
                        if (!empty($categories)) {
                            $categories = $categories[0];
                            echo '<a href="' . esc_url(get_category_link($categories->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'accio'), $categories->name)) . '" >' . $categories->name . '</a></li>';
                        }
                        //***
                        if (is_single()) {
                            echo " ";
                            the_title();
                        }
                    }
                } elseif (is_archive()) {
                    if (is_post_type_archive('post')) {
                        _e('Blog Archives', 'accio');
                    } elseif (is_post_type_archive(TMM_Portfolio::$slug)) {
                        _e('Folio Archives', 'accio');
                    }

                    $queried_object = get_queried_object();
                    switch (@$queried_object->taxonomy) {
                        case 'skills': case 'clients':
                            echo $queried_object->name;
                            break;

                        default:
                            break;
                    }
                } elseif (is_page()) {
                    if ($post->post_parent) {
                        echo ' <a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>';
                    }
                    echo the_title();
                }
            }
        } else {
            wp_nav_menu(array(
                'container' => 'none',
                'theme_location' => 'primary',
                'walker' => new SH_BreadCrumbWalker(),
                'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
            ));
        }
    }

    public static function get_the_category_list($separator = '', $parents = '', $post_id = false) {
        global $wp_rewrite, $cat;
        if (!is_object_in_taxonomy(get_post_type($post_id), 'category'))
            return apply_filters('the_category', '', $separator, $parents);

        $categories = get_the_category($post_id);
        if (empty($categories))
            return apply_filters('the_category', __('Uncategorized', 'accio'), $separator, $parents);

        $rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

        $thelist = '';
        foreach ($categories as $category) {

            if ($cat == $category->term_id) {
                $thelist .= '&nbsp;' . $category->name;
                break;
            } else {
                $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'accio'), $category->name)) . '" ' . $rel . '>' . $category->name . '</a></li>';
            }
        }

        return apply_filters('the_category', $thelist, $separator, $parents);
    }

    public static function get_page_backround($page_id) {

        if ($page_id > 0) {
            $page_bg = TMM_Page::get_page_settings($page_id);

            if (!empty($page_bg['pagebg_type'])) {
                
                if ($page_bg['pagebg_type'] == "image") {
                    
                    if (!empty($page_bg['pagebg_image'])) {

                        if (!$page_bg['pagebg_type_image_option']) {
                            $page_bg['pagebg_type_image_option'] = "repeat";
                        }

                        switch ($page_bg['pagebg_type_image_option']) {
                            case "repeat-x":
                                if (!empty($page_bg['pagebg_image'])) {
                                    return "background: url(" . $page_bg['pagebg_image'] . ") repeat-x 0 0";
                                } else {
                                    return "";
                                }
                                break;

                            case "fixed":
                                if (!empty($page_bg['pagebg_image'])) {
                                    return "background: url(" . $page_bg['pagebg_image'] . ") no-repeat center top fixed;";
                                } else {
                                    return "";
                                }
                                break;

                            default:
                                if (!empty($page_bg['pagebg_image'])) {
                                    return "background: url(" . $page_bg['pagebg_image'] . ") repeat 0 0";
                                } else {
                                    return "";
                                }
                                break;
                        }
                    }
                }

                if ($page_bg['pagebg_type'] == "color") {
                    if (!empty($page_bg['pagebg_color'])) {
                        return "background: " . $page_bg['pagebg_color'];
                    }
                }
            }
        }

        return self::draw_body_bg();
    }

    public static function draw_body_bg() {

        $disable_body_bg = TMM::get_option('disable_body_bg');
        if (!$disable_body_bg) {

            $body_pattern = TMM::get_option('body_pattern');
            $body_pattern_custom_color = TMM::get_option('body_pattern_custom_color');
            $body_bg_color_selected = TMM::get_option('body_bg_color');
            $body_pattern_selected = (int) TMM::get_option('body_pattern_selected');

            switch ($body_pattern_selected) {
                case 0:
                    return "background: " . $body_bg_color_selected . ";";
                    break;
                case 1:
                    return "background: url(" . $body_pattern . ") repeat 0 0;";
                    break;
                case 2:
                    return "background: url(" . $body_pattern . ") repeat 0 0 " . $body_pattern_custom_color . ";";
                    break;
                default:
                    return "";
                    break;
            }
        }

        return "";
    }

    public static function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);

        foreach ($rgb as $key => $color) {
            if ($key > 0)
                echo ',';
            echo $color;
        }
    }

    public static function get_upload_folder() {
        $path = wp_upload_dir();
        $path = $path['basedir'];

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $path = $path . '/thememakers/';
        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        return $path;
    }

    public static function get_upload_folder_uri() {
        $link = wp_upload_dir();
        return $link['baseurl'] . '/thememakers/';
    }

    public static function delete_dir($path) {
        if (is_dir($path)) {
            $it = new RecursiveDirectoryIterator($path);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($path);
        }
    }

    //ajax
    public static function get_resized_image_url() {
        echo TMM_Helper::resize_image($_REQUEST['imgurl'], $_REQUEST['alias']);
        exit;
    }

    /*
     * recursive copy of folders
     */

    public static function recursive_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    self::recursive_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    //ajax
    public static function update_allowed_alias() {
        $data = array();
        parse_str($_REQUEST['values'], $data);
        $data = TMM_Helper::db_quotes_shield($data);
        foreach ($data as $option => $newvalue) {
            if (is_array($newvalue)) {
                self::update_option($option, $newvalue);
            }
        }
    }

    public static function draw_html_option($data) {
        switch ($data['type']) {
            case 'textarea':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <textarea id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer data-area" data-shortcode-field="<?php echo $data['shortcode_field'] ?>"><?php echo $data['default_value'] ?></textarea>
                <span class="preset_description"><?php echo $data['description'] ?></span>
                <?php
                break;
            case 'select':
                if (!isset($data['display'])) {
                    $data['display'] = 1;
                }
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <?php if (!empty($data['options'])): ?>
                    <select <?php if ($data['display'] == 0): ?>style="display: none;"<?php endif; ?> class="js_shortcode_template_changer data-select <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>">

                    <?php foreach ($data['options'] as $key => $text) : ?>
                            <option <?php if ($data['default_value'] == $key) echo 'selected' ?> value="<?php echo $key ?>"><?php echo $text ?></option>
                        <?php endforeach; ?>

                    </select>
                <?php endif; ?>
                <?php
                break;
            case 'text':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <input type="text" value="<?php echo $data['default_value'] ?>" class="js_shortcode_template_changer data-input" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>" />
                <span class="preset_description"><?php echo $data['description'] ?></span>
                <?php
                break;
            case 'color':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <input type="text" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" value="<?php echo $data['default_value'] ?>" class="bg_hex_color text small js_shortcode_template_changer" id="<?php echo $data['id'] ?>">
                <div style="background-color: <?php echo $data['default_value'] ?>" class="bgpicker"></div>
                <span class="preset_description"><?php echo $data['description'] ?></span>
                <?php
                break;
            case 'upload':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <input type="text" id="<?php echo $data['id'] ?>" value="<?php echo $data['default_value'] ?>" class="js_shortcode_template_changer data-input data-upload <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
                <a title="" class="button_upload button-primary" href="#">
                <?php _e('Upload', 'accio'); ?>
                </a>
                <span class="preset_description"><?php echo $data['description'] ?></span>
                <?php
                break;
            case 'checkbox':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <div class="radio-holder">
                    <input <?php if ($data['is_checked']): ?>checked=""<?php endif; ?> type="checkbox" value="<?php if ($data['is_checked']): ?>1<?php else: ?>0<?php endif; ?>" id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer js_shortcode_checkbox_self_update data-check" data-shortcode-field="<?php echo $data['shortcode_field'] ?>">
                    <label for="<?php echo $data['id'] ?>"><span></span><i class="description"><?php echo $data['description'] ?></i></label>
                    <span class="preset_description"><?php echo $data['description'] ?></span>
                </div><!--/ .radio-holder-->
                <?php
                break;
            case 'radio':
                ?>
                <?php if (!empty($data['title'])): ?>
                    <h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
                <?php endif; ?>

                <div class="radio-holder">
                    <input <?php if ($data['values'][0]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][0]['id'] ?>" value="<?php echo $data['values'][0]['value'] ?>" class="js_shortcode_radio_self_update" />
                    <label for="<?php echo $data['values'][0]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][0]['title'] ?></label>

                    <input <?php if ($data['values'][1]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][1]['id'] ?>" value="<?php echo $data['values'][1]['value'] ?>" class="js_shortcode_radio_self_update" />
                    <label for="<?php echo $data['values'][1]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][1]['title'] ?></label>

                    <input type="hidden" id="<?php echo @$data['hidden_id'] ?>" value="<?php echo $data['value'] ?>" class="js_shortcode_template_changer" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
                </div><!--/ .radio-holder-->
                <span class="preset_description"><?php echo $data['description'] ?></span>
                <?php
                break;
        }
    }

    public static function page_title($post) {
        ?>

        <div class="row">

            <div class="col-xs-12">

        		<?php if (is_404()): ?>

					<hgroup class="section-title align-center">
						<h1><?php _e("Page not Found", 'interpress') ?></h1>
					</hgroup>

        		<?php else: ?>

                    <?php if (is_home()): ?>

                        <?php if (TMM::get_option('frontpage') && $new = TMM::get_option('blogpage')): ?>

                            <?php
                            $show_page_title = get_post_meta($new, 'show_page_title', true);
                            $page_title = get_the_title($new);
                            $another_page_title = get_post_meta($new, 'another_page_title', true);
                            $another_page_description = get_post_meta($new, 'another_page_description', true);
                            if (!empty($another_page_title)) {
                                $page_title = $another_page_title;
                            }
                            ?>

                            <?php if ($show_page_title): ?>	

                                <hgroup class="section-title align-center">
                                    <h1><?php echo $page_title ?></h1>
                        			<?php if (!empty($another_page_description)): ?>
                                        <h2><?php echo $another_page_description; ?></h2>
                                    <?php endif; ?>										
                                </hgroup>

                    <?php endif; ?>			

                        <?php else: ?>

                            <hgroup class="section-title align-center">
                                <h2><?php echo bloginfo('description'); ?></h2>
                            </hgroup>

                <?php endif; ?>

                    <?php endif; ?>

                    <?php if (is_single() OR is_page()): ?>

                        <?php
							$show_page_title = get_post_meta($post->ID, 'show_page_title', true);
							$page_title = $post->post_title;
							$another_page_title = get_post_meta($post->ID, 'another_page_title', true);
							$another_page_description = get_post_meta($post->ID, 'another_page_description', true);
							if (!empty($another_page_title)) {
								$page_title = $another_page_title;
							}
                        ?>

                        <?php if ($show_page_title): ?>	

                            <hgroup class="section-title align-center">
                                <h1><?php echo $page_title ?></h1>
                    			<?php if (!empty($another_page_description)): ?>
                                    <h2><?php echo $another_page_description; ?></h2>
                                <?php endif; ?>										
                            </hgroup>

                <?php endif; ?>

                    <?php endif; ?>

                    <?php if (is_search()): global $wp_query; ?>

                        <hgroup class="section-title align-center">
                            <h2>
               					 <?php if (!empty($wp_query->found_posts)): ?>

                                    <?php if ($wp_query->found_posts > 1): ?>
                                        <?php printf(__('%s Search Results for: <i>%s</i>', 'interpress'), $wp_query->found_posts, '<span>' . esc_attr(get_search_query()) . '</span>'); ?>
                                    <?php endif; ?>

                                <?php else: ?>

                                    <?php if (!empty($_GET['s'])): ?>
                                        <?php printf(__('Search Results for: <i>%s</i>', 'interpress'), '<span>' . esc_attr(get_search_query()) . '</span>'); ?>
                                    <?php else: ?>
                                        <?php printf(__('To search the site please enter a valid term', 'interpress'), '<span>' . esc_attr(get_search_query()) . '</span>'); ?>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </h2>
                        </hgroup>

            <?php endif; ?>

                    <?php
                    $queried_object = get_queried_object();
                    $is_defined = false;
                    ?>

                    <?php if (is_category()): ?>

                        <hgroup class="section-title align-center">
                            <h2><?php printf(__('Category: %s', 'interpress'), '<span>' . $queried_object->name . '</span>'); ?></h2>
                        </hgroup>

           			<?php elseif (is_author()): ?>

                        <hgroup class="section-title align-center">
                            <h2><?php printf(__('Author Archive: %s', 'interpress'), '<span>' . single_tag_title('', false) . '</span>'); ?></h2>
                        </hgroup>

            		<?php elseif (is_tag()): ?>

                        <hgroup class="section-title align-center">
                            <h2><?php printf(__('Tag Archives: %s', 'interpress'), '<span>' . single_tag_title('', false) . '</span>'); ?></h2>
                        </hgroup>

            		<?php elseif (is_tax()): ?>


           		<?php endif; ?>

                    <?php if (is_object($queried_object)): ?>
                        <?php if (@$queried_object->taxonomy == 'skills'): ?>
						<hgroup class="section-title align-center">
							<h2><?php printf(__('Folios by Skills: %s', 'interpress'), '<span>' . $queried_object->name . '</span>'); ?></h2>
						</hgroup>
                	<?php elseif (@$queried_object->taxonomy == 'clients'): ?>
						<hgroup class="section-title align-center">
							<h2><?php printf(__('Folios by Clients: %s', 'interpress'), '<span>' . $queried_object->name . '</span>'); ?></h2>
						</hgroup>
               		<?php endif; ?>
                 <?php endif; ?>

                    <?php if (is_archive()): ?>

                        <?php if (is_post_type_archive(TMM_Portfolio::$slug)): ?>

                            <hgroup class="section-title align-center">
                                <h2>
                    			<?php if (is_day()) : ?>
                                        <?php printf(__('Daily Portfolio Archives: %s', 'interpress'), '<span>' . get_the_date() . '</span>'); ?>
                                    <?php elseif (is_month()) : ?>
                                        <?php printf(__('Monthly Portfolio Archives: %s', 'interpress'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'interpress')) . '</span>'); ?>
                                    <?php elseif (is_year()) : ?>
                                        <?php printf(__('Yearly Portfolio Archives: %s', 'interpress'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'interpress')) . '</span>'); ?>
                                    <?php else : ?>
                                        <?php _e('Portfolio Archives', 'interpress'); ?>
                                    <?php endif; ?>
                                </h2>	
                            </hgroup>

                <?php elseif (is_post_type_archive() != TMM_Portfolio::$slug): ?>

                    <?php if (is_day()): ?>
						<hgroup class="section-title align-center">
							<h2><?php printf(__('Daily Archives: %s', 'interpress'), '<span>' . get_the_date() . '</span>'); ?></h2>
						</hgroup>
                    <?php elseif (is_month()): ?>
                        <hgroup class="section-title align-center">
                        	<h2><?php printf(__('Monthly Archives: %s', 'interpress'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'interpress')) . '</span>'); ?></h2>
                        </hgroup>
                    <?php elseif (is_year()): ?>
						<hgroup class="section-title align-center">
							<h2><?php printf(__('Yearly Archives: %s', 'interpress'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'interpress')) . '</span>'); ?></h2>
						</hgroup>
                    <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </div><!--/ .row-->	

        <?php
    }

}

/**
 * Retrieve a post's terms as a list ordered by hierarchy.
 *
 * @param int $post_id Post ID.
 * @param string $taxonomy Taxonomy name.
 * @param string $term_divider Optional. Separate items using this.
 * @param string $reverse Optional. Reverse order of links in string.
 * @return string
 */
class GetTheTermList {

    public function get_the_term_list($post_id, $taxonomy, $term_divider = '/', $reverse = false) {
        $object_terms = wp_get_object_terms($post_id, $taxonomy);
        $parents_assembled_array = array();
        //***
        if (!empty($object_terms)) {
            foreach ($object_terms as $term) {
                $parents_assembled_array[$term->parent][] = $term;
            }
        }
        //***
        $sorting_array = $this->sort_taxonomies_by_parents($parents_assembled_array);
        $term_list = $this->get_the_term_list_links($taxonomy, $sorting_array);
        if ($reverse) {
            $term_list = array_reverse($term_list);
        }
        $result = implode($term_divider, $term_list);

        return $result;
    }

    private function sort_taxonomies_by_parents($data, $parent_id = 0) {
        if (isset($data[$parent_id])) {
            if (!empty($data[$parent_id])) {
                foreach ($data[$parent_id] as $key => $taxonomy_object) {
                    if (isset($data[$taxonomy_object->term_id])) {
                        $data[$parent_id][$key]->childs = $this->sort_taxonomies_by_parents($data, $taxonomy_object->term_id);
                    }
                }

                return $data[$parent_id];
            }
        }

        return array();
    }

    //only for taxonomies. returns array of term links
    private function get_the_term_list_links($taxonomy, $data, $result = array()) {
        if (!empty($data)) {
            foreach ($data as $term) {
                $result[] = '<a rel="tag" href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';
                if (!empty($term->childs)) {
                    //***
                    $res = $this->get_the_term_list_links($taxonomy, $term->childs, array());
                    if (!empty($res)) {
                        //***
                        foreach ($res as $val) {
                            if (!is_array($val)) {
                                $result[] = $val;
                            }
                        }
                        //***
                    }
                    //***
                }
            }
        }

        return $result;
    }

}

class SH_BreadCrumbWalker extends Walker {

    /**
     * @see Walker::$tree_type
     * @var string
     */
    var $tree_type = array('post_type', 'taxonomy', 'custom');

    /**
     * @see Walker::$db_fields
     * @var array
     */
    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    /**
     * delimiter for crumbs
     * @var string
     */
    var $delimiter = '';

    /**
     * @see Walker::start_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

        //Check if menu item is an ancestor of the current page
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $current_identifiers = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor');
        $ancestor_of_current = array_intersect($current_identifiers, $classes);


        if ($ancestor_of_current) {
            $title = apply_filters('the_title', $item->title, $item->ID);

            //Preceed with delimter for all but the first item.
            if (0 != $depth)
                $output .= $this->delimiter;

            //Link tag attributes
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

            //Add to the HTML output
            $output .= '<a' . $attributes . '>' . $title . '</a>';
        }
    }

}
