<?php

/**
 * Layout of our travel block.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordian-slider' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordian-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$section_title           = get_field('section_title') ?? 'Title';
$accordian               = get_field('accordian');
$footer_content          = get_field('footer_content');
$footer_title            = get_field('footer_title');

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="video-tab">
        <div class=" video-swiper-container">
            <div class="video-swiper__row">
                <?php if ($accordian && is_array($accordian)) :  ?>
                    <div class="video-swiper__col-video ">
                        <div class="video-swiper ">
                            <div class="swiper-wrapper ">
                                <?php foreach ($accordian as $accordian_item) :  ?>
                                    <?php if (isset($accordian_item['video'])) :  ?>
                                        <div class="swiper-slide" <?php echo (isset($accordian_item['duration']) && is_numeric($accordian_item['duration'])) ? 'data-swiper-autoplay="' . $accordian_item['duration'] . '"' : ''; ?>>
                                            <div class="video-container">
                                                <?php if (strpos($accordian_item['video'], 'vimeo.com') !== false) : ?>
                                                    <iframe src="<?php echo esc_url($accordian_item['video']); ?>?background=1" frameborder="0" allow="autoplay"></iframe>
                                                <?php else : ?>
                                                    <video src="<?php echo esc_url($accordian_item['video']); ?>" poster="<?php echo get_template_directory_uri() . '/assets/img/image.png'  ?> " preload="none" muted></video>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="video-swiper__col-pause-button pause-button-js"></button>
                    </div>
                <?php endif; ?>

                <div class="video-swiper__col-accordian ">
                    <div class="video-swiper__col__container">
                        <div class="accordian-container">
                            <?php if ($section_title) :  ?>
                                <div class="video-tab__title">
                                    <?php echo $section_title; ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            $count = 0;
                            if ($accordian && is_array($accordian)) :
                            ?>
                                <?php if (isset($accordian_item['video'])) :  ?>
                                    <div class="slider-accordion go-to-buttons">
                                        <?php foreach ($accordian as $accordian_item) :
                                            $title = isset($accordian_item['title']) ? $accordian_item['title'] : false;
                                            $content = isset($accordian_item['content']) ? $accordian_item['content'] : false;
                                        ?>
                                            <div class="slider-accordion-item <?php echo $count == 0 ? 'active' : ''   ?>  ">
                                                <?php if ($title) :

                                                ?>
                                                    <button class="slider-accordion-header" data-slide="<?php echo $count; ?>"><?php echo esc_attr($title); ?></button>
                                                <?php endif; ?>
                                                <div class="slider-accordion-content">
                                                    <?php if ($content) :  ?>
                                                        <p><?php echo esc_attr($content); ?></p>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        <?php
                                            $count++;
                                        endforeach; ?>
                                    </div>
                            <?php endif;
                            endif; ?>
                        </div>
                        <?php if ($footer_content || $footer_title) :  ?>
                            <div class="slider-accordion__commont-note">
                                <?php if ($footer_title) :  ?>
                                    <div class="slider-accordion__commont-note__title">
                                        <?php echo esc_attr($footer_title); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($footer_content) :  ?>
                                    <p>
                                        <?php echo esc_attr($footer_content); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>