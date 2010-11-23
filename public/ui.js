//window.onload = function(){
//};

function changeTab(tabId)
{
    var tabs = document.getElementsByTagName("article");
    for (var index=0; index < tabs.length; index++) {
        var tab = tabs[index];
        console.log(tab);
        if (tab.id == tabId) {
            tab.className = "selected";
        } else {
            tab.className = "";
        }
    }
}
