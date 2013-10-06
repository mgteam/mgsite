<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('PaginatorHelper', 'View/Helper');

class BootstrapPaginatorHelper extends PaginatorHelper {
	public $helpers = array('Form', 'Html');
	/**
	 * overwrite the paginator helper's default prev method to use bootstrap layout
	 */
    public function prev($title = '«', $options = array('tag'=>'li'), $disabledTitle = null, $disabledOptions = array('class' => 'prev disabled active', 'tag' => 'li')) {
    	if ( $disabledTitle == null ) {
    		$disabledTitle = parent::link($title, array());
    		$disabledOptions = array_merge(array('escape' => false), $disabledOptions);
    	}
    	return parent::prev($title, $options, $disabledTitle, $disabledOptions);
    }

    /**
     * overwrite the paginator helper's default next method to use bootstrap layout
     */
    public function next($title = '»', $options = array('tag'=>'li'), $disabledTitle = null, $disabledOptions = array('class' => 'prev disabled active', 'tag' => 'li')) {
    	if ( $disabledTitle == null ) {
    		$disabledTitle = parent::link($title, array());
    		$disabledOptions = array_merge(array('escape' => false), $disabledOptions);
    	}
    	return parent::next($title, $options, $disabledTitle, $disabledOptions);
    }

    /**
     * overwrite the paginator helper's default number method to user bootstrap syntax
     */
    public function numbers($options = array()) {
    	$default = array(
    		'separator' => '', 
    		'tag'=>'li', 
    		'currentTag'=>'li', 
    		'currentTag' => 'a', 
    		'currentClass'=>'active', 
    		'modulus' => 3, 
    		'first' => 1, 
    		'last' => 1,
    		'ellipsis' => '<li class="disabled"><a href="#">...</a></li>',
    		'escape' => false,
    	);
    	$options = array_merge($options, $default);
    	return parent::numbers($options);
    }

    /**
     * show the pagination row
     */
    public function pagination() {
    	$output = "<ul>"
    		. $this->prev()
    		. $this->numbers()
    		. $this->next()
    		. "</ul>";
    	return $output;
    }

    public function pager() {
        $format = "Page {$this->pageNavigatorWithLinks()} of {:pages} | View {$this->pageSizeLimiter()} per page | Total <b>{:count}</b> records";
        
        return '<div class="pagination-section">' . $this->counter(array('format' => $format)) . '</div>';
    }

    /**
     * pageSizeLimiter method
     *
     * creates a select list with the specified page sizes
     * allows to change the size of the currently displayed list (number of items the paginator component returns)
     *
     * @param $options array()
     * @return string
     */
    public function pageSizeLimiter($options = array()) {
        $currentLimit = $this->getCurrentPagingInfo('limit');

    	$default = array(
    		'options' => array(
    			'2' => 2,
    			'5' => 5,
    			'10' => 10, 
    			'20' => 20, 
    			'30' => 30, 
    			'50' => 50, 
    			'100' => 100
    		),
            'type' => 'select', 
            'default' => $currentLimit,
            'onChange' => '_PaginatorHelper__updatePageSize(this.value)',
            'style' => 'width:65px;',
            'name' => 'limit',
            'div' => false,
            'label' => false,
    	);

    	$options = array_merge($default, $options);

    	$urlParams = $this->getUrlParams(array('limit' => "--LIMIT--", 'page' => '1'));

    	$url = $this->url($urlParams);


    	// script to handle the change event of the select list
    	$selectChangeScript = '<script type="text/javascript">
function _PaginatorHelper__updatePageSize(value) { 
	var url = "'. $url . '";
	window.location.href = url.replace("--LIMIT--", value);
} 
</script>';
		
		// select list
		$selectList = $this->Form->input(
			'limit', 
			$options
		);

		return $selectChangeScript . $selectList;
    }

    /**
     * shows an input box to navigate to the specified page
     */
    public function pageNavigator() {
        $currentPageNumber = $this->current();

        $totalPages = $this->counter(array('format' => '{:pages}'));

    	$urlParams = $this->getUrlParams(array('page' => '--PAGE--'));

    	$url = $this->url($urlParams);

    	$inputKeypressScript = "<script type='text/javascript'>
function _PaginatorHelper__updatePageNumber(e, value) {
	var url = '{$url}';
	if (e.which == 13) {
		var page = parseInt(value);
        var totalPages = {$totalPages};
		if (isNaN(page)) {
			page = 1;
		}
        if (page > totalPages) { page = totalPages; }
		window.location.href = url.replace('--PAGE--', page);
	}
}
</script>";

    	$inputBox = $this->Form->input(
    		'page',
    		array(
    			'type' => 'text',
    			'name' => 'page',
    			'div' => false,
    			'label' => false,
    			'onkeyup' => '_PaginatorHelper__updatePageNumber(event, this.value)',
    			'default' => $currentPageNumber,
    			'style' => 'width:30px;',
                'escape' => false,
    		)
    	);

    	return $inputKeypressScript . $inputBox;
    }

    public function pageNavigatorWithLinks() {
        $output = '<div class="input-prepend input-append inline">';
        $output .= $this->prev(
            '<i class="icon-chevron-left"></i>',
            array('tag' => false, 'escape' => false, 'class' => 'btn'),
            '<i class="icon-chevron-left"></i>',
            array('class' => 'btn disabled', 'escape' => false, 'tag' => false)
        );
        $output .= $this->pageNavigator();
        $output .= $this->next(
            ' <i class="icon-chevron-right"></i>',
            array('tag' => false, 'escape' => false, 'class' => 'btn'),
            ' <i class="icon-chevron-right"></i>',
            array('class' => 'btn disabled', 'escape' => false, 'tag' => false)
        );
        $output .= '</div>';
        return $output;
    }

    /**
     * returns all the url parameters in format requird by the url function
     *
     * @param $options array - array to add to the url params
     * @return array
     */

    private function getUrlParams($options = array()) {
    	// create a url by appending named params
    	$urlParams = array_merge($this->params->params['named'], $options);
    	// check if there are any querystring params and append those as well
    	if (!empty($this->params->query)) {
    		$urlParams = array_merge($urlParams, array('?' => $this->params->query));
    	}

    	return $urlParams;
    }

    /**
     * returns the current pagination limit: either default or set using the named param
     *
     * @return mixed
     */
    private function getCurrentPagingInfo($key = '') {
    	// get the limit set in the controller
    	$model = current($this->params->params['paging']);
    	$defaultValue = $model[$key];

    	// if the limit is changed on page, then pick it, otherwise use the limit set in controller
    	$currentValue = empty($this->options['url'][$key]) ? $defaultValue : $this->options['url'][$key];

    	return $currentValue;
    }
}