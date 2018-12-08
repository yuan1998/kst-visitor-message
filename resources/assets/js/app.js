/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

var a = {
    "recId"           : 700586023,
    "visitorId"       : "3d6a8aa6258849deb057a6873eefeda4",
    "visitorName"     : "陕西西安|官网",
    "curEnterTime"    : "2018-12-08 14:50:33",
    "curStayTime"     : 9,
    "sourceIp"        : "117.136.25.221",
    "sourceProvince"  : "陕西西安",
    "sourceIpInfo"    : "移动",
    "requestType"     : "",
    "endType"         : "",
    "diaStartTime"    : "",
    "diaEndTime"      : "",
    "terminalType"    : "tt_mb",
    "visitorSendNum"  : 0,
    "csSendNum"       : 0,
    "sourceUrl"       : "https://wap.sogou.com/bill_cpc?v=1&p=WJ80$xzfh7PecAL0y3P9ciVIN8kqpI7U2QYCapP62aAEWt9zNo7COdtMY4gY759iIDWm5BKAl7EssXngnQGVqD9sHA$PtdDTb2$8BnW07et5rdELcnF2cMmzp3QaDd58vTQa6C33NYL2UDeGFvevFvevFwZ2aB3EplGhv6o3r5FCtZTCGIJ8tc$3dBa8t@QrvsvrUsSq0N1t0yZGXYht0yGGkchGRwRlCtxY28W@lAP7YQxIB3I$BpBkBpI$YVhSXfHbgVivOF3xtNftEPmO7e0Bkq3pnI6Vje0Eu@NLvUAet89QjF9BuUXetFVuj49zuIHBQJPBuJI37g9eOk6epoaoBjVpKfxjIoeA6wlpV1HxQQz36w3PvU$$oYuJWbJBorpPIb9Ohj9peozuOoBuVozuBuYkaW6OyoZpUAJtFwgByXhoYvRVZDqYwtSmBpxPYpPkRnJqwXkng9eIfUJQeHYBSOBiyVPIOBvUxjvFZWZ3GVOIBQAqOZNPqq$OQVUjVq7gJqogJkJJ3qcmOIaAC9wPqkGNwJFAipwIa7c1la6ph9e2FAixGRGS8pyo7Eykse09Vl33IPzXjgpxFl9jyZGR3Qcmi7a7Bj9QyLxwlkj2nicx&q=WJe0lllllylx&keyword=%E6%BF%80%E5%85%89%E8%84%B1%E6%AF%9B%E5%A4%9A%E5%B0%91%E9%92%B1&ml=0&mc=30&ma=75,0,94,155,94,155,360,610&mcv=44&pcl=94,155&sed=0&sct=0",
    "sourceType"      : "搜索引擎",
    "searchEngine"    : "Sogou",
    "keyword"         : "激光脱毛多少钱",
    "firstCsId"       : "",
    "joinCsIds"       : "",
    "dialogType"      : "dt_v_ov",
    "firstVisitTime"  : "2018-12-08 14:50:33",
    "preVisitTime"    : "",
    "totalVisitTime"  : 1,
    "diaPage"         : "",
    "curFirstViewPage": "http://m1.hcmlrs.com/zt/zd/?A201B2C3P1R220000E03-mox20180925&025503xom-swtzd",
    "curVisitorPages" : 1,
    "preVisitPages"   : "",
    "operatingSystem" : "Android 7.1.2",
    "browser"         : "Chrome 55.0.2883.91",
    "info"            : "",
    "siteName"        : "官网",
    "siteId"          : 116431
}
