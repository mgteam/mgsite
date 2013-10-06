<?php if ( isset( $quickLinkRequestAction ) ): ?>
<?php $quickLinks = $this->requestAction( $quickLinkRequestAction ); ?>

<?php if ( !empty( $quickLinks ) ): ?>
    <div class="sidebar-section">
        <div class="section-title"><?php echo __('Quick Links'); ?></div>
        <div class="inner-container">
        <?php
            echo "<ul >";
            foreach ($quickLinks['sections'] as $section => $links) {
                echo "<li class='group-title'>" . $section . "</li>";
                foreach ($links as $title => $url) {
                    echo "<li>" . $this->Html->link( $title, $url ) . "</li>";
                }
            }
            echo "</ul>";
        ?>
        </div>
    </div>
<?php endif; ?>
<?php endif; ?>