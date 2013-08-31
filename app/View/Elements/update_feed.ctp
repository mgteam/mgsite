<div id="update_feed_outer">
    <span>Update Status</span>
    <span>Add Photos/Videos</span>
    <div id="feed_tab_1" class="">
		<textarea placeholder="What's in your mind?"></textarea>
		<div class="feed-arrow-border"></div>
		<div class="feed-arrow"></div>
		<div class=""></div>
	</div>
    <div id="feed_tab_2" class="">
		<textarea placeholder="What's in your mind?"></textarea>
		<div class="feed-arrow-border"></div>
		<div class="feed-arrow"></div>
	</div>
</div>
<script type="text/javascript">
// Script for feeds tabs
    var tabs = document.querySelectorAll("#update_feed_outer > span");
    var panels = document.querySelectorAll("#update_feed_outer > div");
    var length = tabs.length;
    var currentTab;
    var currentPanel;

    function getToggler(newTab, newPanel) {
      return function() {
        currentTab.className = "feed_tab inactiveTab";
        currentPanel.className = "inactivePanel";
        newTab.className = "feed_tab activeTab";
        newPanel.className = "activePanel";
        currentTab = newTab;
        currentPanel = newPanel;
      }
    }

    for (var i = 0; i < length; i++) {
      var tab = tabs[i];
      var panel = panels[i];

      tab.className = "feed_tab inactiveTab";
      tab.onclick = getToggler(tab, panel);
      panel.className = "inactivePanel";
    }

    currentTab = tabs[0];
    currentPanel = panels[0];
    currentTab.className = "feed_tab activeTab";
    currentPanel.className = "activePanel";
</script>