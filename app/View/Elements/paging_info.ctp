<!--<div class="clear-both"></div>-->
<p class='pagination-info'>
	<?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
	?>
</p>