window.onload = function(){
    var search = new RegExp("#tab([0-9]+)");
    var hash = window.location.hash;
    var match = search.exec(hash);
    if (match !== null) {
        var tabId = match[1];
        changeTab("tab"+tabId);
    }
};

/**
 * Change tab
 * 
 * @param   int     tabId   Tab identifier
 */
function changeTab(tabId)
{
    // Select the tab content
    var tabs = document.getElementsByTagName("article");
    for (var index=0; index < tabs.length; index++) {
        var tab = tabs[index];
        if (tab.id == tabId) {
            tab.className = "selected";
        } else {
            tab.className = "";
        }
    }

    // Select the tab link
    var links = document.getElementById("tabs").getElementsByTagName("a");
    for (index=0; index < links.length; index++) {
        var link = links[index];
        if (link.rel == tabId) {
            link.parentNode.className = "selected";
        } else {
            link.parentNode.className = "";
        }
    }
}
