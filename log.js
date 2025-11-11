// log.js – JS 版本日志（无需服务器）
module.exports = function(data) {
    console.log('LOG:', new Date().toISOString(), data);  // 浏览器控制台可见
    
    // 可选：发到 Google Sheets（需配置）
    // fetch('https://script.google.com/macros/s/YOUR_SHEET_ID/exec', {
    //     method: 'POST',
    //     body: JSON.stringify(data)
    // });
};
