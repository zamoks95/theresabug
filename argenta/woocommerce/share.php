<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.13
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly
?>

<div class="yith-wcwl-share">
    <h3 class="title text-left inline"><?php echo wp_kses( $share_title, 'default' ); ?></h3>
    <ul class="socialbar small inline">
        <?php if( $share_facebook_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="social rounded default facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( $share_link_url ); ?>" title="<?php esc_attr_e( 'Facebook', 'argenta'  ) ?>">
                    <span class="icon ion-social-facebook"></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="social rounded default twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $share_twitter_summary ); ?>,+<?php echo rawurlencode( get_permalink() ); ?>" title="<?php esc_attr_e( 'Twitter', 'argenta'  ) ?>">
                    <span class="icon ion-social-twitter"></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="social rounded default pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( $share_link_url ); ?>&amp;description=<?php echo urlencode( esc_attr( $share_summary ) ); ?>&amp;media=<?php echo esc_url( $share_image_url ); ?>" title="<?php esc_attr_e( 'Pinterest', 'argenta'  ) ?>" onclick="window.open(this.href); return false;">
                    <span class="icon ion-social-pinterest-outline"></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="social rounded default googleplus" href="https://plus.google.com/share?url=<?php echo esc_url( $share_link_url ); ?>&title=<?php echo urlencode( $share_link_title ); ?>" title="<?php esc_attr_e( 'Google+', 'argenta'  ) ?>" onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                    <span class="icon ion-social-googleplus-outline"></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a class="social rounded default" href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject', esc_html__( 'I wanted you to see this site', 'argenta'  ) ) )?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body', $share_link_url ) ?>&amp;title=<?php echo esc_attr( $share_link_title ); ?>" title="<?php esc_attr_e( 'Email', 'argenta'  ) ?>">
                    <span class="icon ion-ios-email-outline"></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>