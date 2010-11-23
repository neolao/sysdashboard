//window.onload = function(){
//};

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
