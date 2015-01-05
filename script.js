// Script for OSD Outdated Browser
(function () {
    var cookie = "##COOKIE##";
    var cont = document.getElementById('osd-outdated-browser');

    document.getElementById('osd-outdated-browser-close').onclick = closeOutdatedBrowserBanner;

    // Closes the banner
    function closeOutdatedBrowserBanner() {
        cont.parentElement.removeChild(cont);
        if (cookie === "no-cookie") {
            return;
        }

        var date = new Date();
        if (cookie == "minutes") {
            date.setMinutes(date.getMinutes() + 30);
        } else if (cookie == "hour") {
            date.setHours(date.getHours() + 1);
        } else if (cookie == "day") {
            date.setDate(date.getDate() + 1);
        } else if (cookie == "month") {
            date.setMonth(date.getMonth() + 1);
        } else if (cookie == "year") {
            date.setFullYear(date.getFullYear() + 1);
        }
        date = (cookie == "session") ? "" : "; expires=" + date.toUTCString() + ";";
        document.cookie = "osd_outdated_browser=closed;" + date + " path=/";
    }
})();