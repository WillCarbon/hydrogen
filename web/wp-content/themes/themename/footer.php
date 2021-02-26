<?php
/**
 * Footer
 */
?>

    </main

    <footer class="c-footer">
        <div class="c-footer__wrap o-wrapper-centre">

            <div class="c-footer-menu">
                <?php
                    get_template_part('components/layout/nav', 'footer');
                ?>
            </div>

            <div class="c-footer-author">
                <a href="https://www.carboncreative.net/" target="_blank">Website Design Manchester</a> by Carbon Creative
            </div>

        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>
