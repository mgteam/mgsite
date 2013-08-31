<span class='csv-export-img'>
	<?php
		$url = am(array('action'=>'export','admin'=>true), $this->passedArgs);
		echo $this->Html->link(
			'Export',$url,
			array(
				'escape'=>false,
				'class' => 'button'
			)
		);
	?>
</span>