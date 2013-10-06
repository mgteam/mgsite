<?php if ( isset( $filterRequestAction ) ): ?>
<?php 
    $filters = $this->requestAction( $filterRequestAction );
    if ( !empty( $filters ) ):
?>
    <div class="sidebar-section">
        <div class="section-title"><?php echo __('Filters'); ?></div>
        <div class="inner-container">
            <?php
                echo $this->Form->create();
                foreach ($filters['fields'] as $field => $options) {
                    echo $this->Form->input(
                        $field, 
                        array_merge(
                            array(
                                'label' => false, 
                                'div' => false, 
                                'class' => 'span12'
                            ),
                            $options
                        )
                    );
                }
                echo "<div class='filter-buttons'>";
                echo $this->TB->button(__('Filter'), array('class' => 'btn-primary'));
                echo "</div>";
                echo $this->Form->end();
            ?>
        </div>
    </div>
<?php endif; ?>
<?php endif; ?>