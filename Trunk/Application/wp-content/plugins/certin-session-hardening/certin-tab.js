const KEY = "certin_tabs";
const tabId = Date.now() + Math.random();

// Register tab
let tabs = JSON.parse(localStorage.getItem(KEY) || "[]");
tabs.push(tabId);
localStorage.setItem(KEY, JSON.stringify(tabs));

// On tab close
window.addEventListener("beforeunload", () => {
    let tabs = JSON.parse(localStorage.getItem(KEY) || "[]");
    tabs = tabs.filter(t => t !== tabId);
    localStorage.setItem(KEY, JSON.stringify(tabs));

    if (tabs.length === 0) {
        navigator.sendBeacon(
            certinData.ajaxUrl + "?action=certin_logout"
        );
    }
});