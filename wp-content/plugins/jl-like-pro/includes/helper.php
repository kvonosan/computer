<?php

class PlgJLLikeProHelper
{
    var $params = null;

    static $defaultSettings = array(
        'addfacebook'           => 0,
        'addvk'                 => 0,
        'addtw'                 => 0,
        'addod'                 => 0,
        'addgp'                 => 0,
        'addmail'               => 0,
        'addlin'                => 0,
        'addpi'                 => 0,
        'addall'                => 0,
        'jqload'                => 0,
        'position_content'      => 0,
        'shares_position'       => 1,
        'allow_in_category'     => 0,
        'typesget'              => 0,
        'disable_more_likes'    => 0,
        'default_image'         => '',
        'pathbase'              => '',
        'buttons_contayner'     => '',
        'button_text'           => '',
        'parent_contayner'     => 'div.jllikeproSharesContayner',
        'categories'            => array(),
        'locale'                => 'en_US',
        'desc_source_one'       => 'desc',
        'desc_source_two'       => 'full',
        'desc_source_three'     => 'meta',
        'enable_opengraph'     => 0,
        'img_source'           => 'text'
    );

    protected static
        $instance = null,
        $postImages = array();

    /**
     * Пример вывода лайков в любом месте макетов, шаблонов и т.п.
     * require_once JPATH_ROOT .'plugins/content/jllikepro/helper.php';
     * $helper = PlgJLLikeProHelper::getInstance();
     * $helper->loadScriptAndStyle(0); //1-если в категории, 0-если в контенте
     * echo $helper->ShowIN($id, $link, $title, $image, $desc, $enable_opengraph);
     */


    function __construct($params = null)
    {
        $this->params = $params;
    }

    public static function getInstance($params = null)
    {
        if (self::$instance === null) {
            if (!$params) {
                $params = self::getPluginParams();
            }
            self::$instance = new PlgJLLikeProHelper($params);
        }

        return self::$instance;
    }

    /**
     * Кнопки шары
     * @param $id не нужный параметр, на будущее
     * @return string
     */
    function ShowIn($id, $link='', $title='', $image='', $desc='')
    {
        $position_content = $this->params['position_content'];

        if ($position_content == 1)
        {
            $position_buttons = '_right';
        }
        else if
        ($position_content == 0)
        {
            $position_buttons = '_left';
        }
        else
        {
            $position_buttons = '';
        }

        if(empty($image))
        {
            $image = trim($this->params['default_image']);
        }

        $desc = strip_tags($desc);
        $desc = $this->limittext($desc, 200);
        $desc = str_replace(array('"', "'"), '', $desc);
        $desc = str_replace("\n", ' ', $desc);

        $titlefc = __('Facebook', 'jl-like-pro');
        $titlevk = __('VKontacte', 'jl-like-pro');
        $titletw = __('Twitter', 'jl-like-pro');
        $titleod = __('Odnoklassniki', 'jl-like-pro');
        $titlegg = __('Google +', 'jl-like-pro');
        $titlemm = __('Mail.ru', 'jl-like-pro');
        $titleli = __('LinkedIn', 'jl-like-pro');
        $titlepi = __('Pinterest', 'jl-like-pro');
        $titleAll = __('All Likes counter', 'jl-like-pro');

        $scriptPage = '';
        $scriptPage .= <<<HTML
				<div class="jllikeproSharesContayner jllikepro_{$id}">
				<input type="hidden" class="link-to-share" id="link-to-share-$id" value="$link"/>
				<input type="hidden" class="share-title" id="share-title-$id" value="$title"/>
				<input type="hidden" class="share-image" id="share-image-$id" value="$image"/>
				<input type="hidden" class="share-desc" id="share-desc-$id" value="$desc"/>
				<input type="hidden" class="share-id" value="{$id}"/>
HTML;

        if($this->params['disable_more_likes'] && !empty($_COOKIE['jllikepro_article_'.$id])){
            $scriptPage .= '<div class="disable_more_likes"></div>';
        }

        $buttonText = trim($this->params['button_text']);

        if(!empty($buttonText)){
            $scriptPage .= '<div class="button_text">'.$buttonText.'</div>';
        }

        $scriptPage .= <<<HTML

				<div class="event-container" >
				<div class="likes-block$position_buttons">
HTML;
        if ($this->params['addfacebook']) {
            $scriptPage .= <<<HTML
					<a title="$titlefc" class="like l-fb" id="l-fb-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
        if ($this->params['addvk']) {
            $scriptPage .= <<<HTML
					<a title="$titlevk" class="like l-vk" id="l-vk-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
        if ($this->params['addtw']) {
            $scriptPage .= <<<HTML
					<a title="$titletw" class="like l-tw" id="l-tw-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
        if ($this->params['addod']) {
            $scriptPage .= <<<HTML
					<a title="$titleod" class="like l-ok" id="l-ok-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
        if ($this->params['addgp']) {
            $scriptPage .= <<<HTML
					<a title="$titlegg" class="like l-gp" id="l-gp-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
        if ($this->params['addmail']) {
            $scriptPage .= <<<HTML
					<a title="$titlemm" class="like l-ml" id="l-ml-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }

        if ($this->params['addlin']) {
            $scriptPage .= <<<HTML
					<a title="$titleli" class="like l-ln" id="l-ln-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }

        if ($this->params['addpi']) {
            $scriptPage .= <<<HTML
					<a title="$titlepi" class="like l-pinteres" id="l-pinteres-$id">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>
HTML;
        }
		if ($this->params['addall']) {
        $scriptPage .= <<<HTML
					<a title="$titleAll" class="l-all" id="l-all-$id">
					<i class="l-ico"></i>
					<span class="l-count l-all-count" id="l-all-count-$id"></span>
					</a>
HTML;
		}
        $scriptPage .= <<<HTML
						<div style="line-height: 8px;" >
								<a style="background:none; text-decoration:none; color: #c0c0c0; font-family: arial,helvetica,sans-serif; font-size: 5pt; border-bottom: none !important; line-height: 6px;" target="_blank" href="http://joomline.org/wordpress/395-wllikepro.html">Social Like WordPress</a>
						</div>
					</div>
				</div>
			</div>
HTML;

        return $scriptPage;
    }


    function getShareText($metadesc, $introtext, $text)
    {
        $desc_source_one =   $this->params['desc_source_one'];
        $desc_source_two =   $this->params['desc_source_two'];
        $desc_source_three = $this->params['desc_source_three'];

        switch($desc_source_one)
        {
            case 'full':
                $source_one = $text;
                break;
            case 'meta':
                $source_one = $metadesc;
                break;
            default:
                $source_one = $introtext;
                break;
        }

        switch($desc_source_two)
        {
            case 'desc':
                $source_two = $introtext;
                break;
            case 'meta':
                $source_two = $metadesc;
                break;
            default:
                $source_two = $text;
                break;
        }

        switch($desc_source_three)
        {
            case 'desc':
                $source_three = $introtext;
                break;
            case 'full':
                $source_three = $text;
                break;
            default:
                $source_three = $metadesc;
                break;
        }

        $source_one = trim($source_one);
        $source_two = trim($source_two);
        $source_three = trim($source_three);

        $desc = '';

        if(!empty($source_one))
        {
            $desc = $source_one;
        }
        else if(!empty($source_two))
        {
            $desc = $source_two;
        }
        else if(!empty($source_three))
        {
            $desc = $source_three;
        }

        $desc = strip_tags($desc);

        return $desc;
    }

    static function getPluginParams()
    {
        $options = get_option('jllikepro_plgn_options');
        if (!$options)
        {
            add_option('jllikepro_plgn_options', self::$defaultSettings, '', 'yes');
        }
        $options = array_merge(self::$defaultSettings, $options);
        return $options;
    }

    static function request($name, $default=null)
    {
        $data = (isset($_REQUEST [$name])) ? $_REQUEST [$name] : $default;
        return $data;
    }

    public function getImage($post)
    {
        if(!isset($postImages[$post->ID]))
        {
            $image = '';
            if($this->params['img_source'] == 'thumb')
            {
                $image = $this->getPostThumbinail( $post->ID );
            }

            if(empty($image))
            {
                $postText = explode('<!--more-->', $post->post_content);
                $desc = $postText[0];
                $full = (isset($postText[1])) ? $postText[1] : '';
                $image = $this->extractImageFromText($desc, $full);
            }
            $postImages[$post->ID] = $image;
        }

        return $postImages[$post->ID];
    }

    private function getPostThumbinail( $postID )
    {
        $image = '';
        $post_thumbnail_id = get_post_thumbnail_id( $postID );
        if($post_thumbnail_id)
        {
            $size = 'post-thumbnail';
            $size = apply_filters( 'post_thumbnail_size', $size );
            $imageSrc = wp_get_attachment_image_src($post_thumbnail_id, $size);
            if(!empty($imageSrc[0]))
            {
                $image = $imageSrc[0];
            }
        }
        return $image;
    }

    private function extractImageFromText( $introtext, $fulltext = '' )
    {
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';

        preg_match ($regex, $introtext, $matches);

        if(!count($matches))
        {
            preg_match ($regex, $fulltext, $matches);
        }

        $images = (count($matches)) ? $matches : array();

        $image = '';

        if (count($images))
        {
            $image = $images[2];
        }

        if(!empty($image))
        {
        if (!preg_match("#^http|^https|^ftp#i", $image))
        {
            $image = is_file( ABSPATH . '/' . $image ) ? $image : '';

            if(strpos($image, '/') === 0)
            {
                $image = substr($image, 1);
            }

            $image = '/'.$image;

            }
        }
        else
        {
            $image = '';
        }

        return $image;
    }

    private function limittext($wordtext, $maxchar)
    {
        $text = '';
        $textLength = mb_strlen($wordtext);

        if($textLength <= $maxchar)
        {
            return $wordtext;
        }

        $words = explode(' ', $wordtext);

        foreach ($words as $word)
        {
            if(mb_strlen($text . ' ' . $word) > $maxchar - 1)
            {
                break;
            }
            $text .= ' ' . $word;
        }

        return $text;
    }

    function addOpenGraphTags($post)
    {
        if($post->ID == 0){
            return;
        }

        $postText = explode('<!--more-->', $post->post_content);
        $desc = $postText[0];
        $full = (isset($postText[1])) ? $postText[1] : '';

        $title = $post->post_title;
        $text = $this->getShareText('', $desc, $full);
        $image = $this->getImage($post);

        if(empty($image))
        {
            $image = trim($this->params['default_image']);
        }
        ?>
            <meta name="og:type" content="article" />
        <?php
        if(!empty($title)){
            ?>
            <meta name="og:title" content="<?php echo $title; ?>" />
            <?php
        }
        if(!empty($text)){
            ?>
            <meta name="og:description" content="<?php echo $text; ?>" />
            <?php
        }
        if(!empty($image)){
            ?>
            <meta name="og:image" content="<?php echo $image; ?>" />
            <link rel="image_src" href="<?php echo $image; ?>" />
            <?php
        }
    }
}