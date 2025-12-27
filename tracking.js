// ============================================
// TRACKING.JS - Parental Control System
// ============================================

// Load video with parental controls
function loadVideo(iframeId, videoName, category, duration, videoId) {
    // Check if blocked
    const blockedCategories = JSON.parse(localStorage.getItem('blockedCategories') || '[]');
    if (blockedCategories.includes(category)) {
        alert(' Sorry! This video is blocked by parental controls.\n\nCategory: ' + category + '\n\nAsk your parents to unblock it!');
        return;
    }

    // Check time limit
    const timeLimit = parseInt(localStorage.getItem('timeLimit') || '120');
    const history = JSON.parse(localStorage.getItem('watchHistory') || '[]');
    const today = new Date().toDateString();
    const todayVideos = history.filter(v => new Date(v.timestamp).toDateString() === today);
    const todayTime = todayVideos.reduce((sum, v) => sum + (v.duration || 0), 0);
    
    if (todayTime >= timeLimit) {
        alert(' Screen time limit reached!\n\nYou\'ve watched ' + todayTime + ' minutes today.\nLimit: ' + timeLimit + ' minutes.\n\nCome back tomorrow! ');
        return;
    }

    // Track it
    history.push({
        title: videoName,
        category: category,
        duration: duration,
        timestamp: new Date().toLocaleString()
    });
    localStorage.setItem('watchHistory', JSON.stringify(history));

    // Load iframe
    const iframe = document.getElementById(iframeId);
    if (iframe) {
        iframe.src = 'https://www.youtube.com/embed/' + videoId;
        iframe.classList.add('loaded');
    }

    // Hide play button
    const btn = document.getElementById('btn-' + iframeId);
    if (btn) {
        btn.classList.add('hidden');
    }

    // Update screen time
    updateScreenTime();
}

// Update screen time display
function updateScreenTime() {
    const history = JSON.parse(localStorage.getItem('watchHistory') || '[]');
    const today = new Date().toDateString();
    const todayVideos = history.filter(v => new Date(v.timestamp).toDateString() === today);
    const todayTime = todayVideos.reduce((sum, v) => sum + (v.duration || 0), 0);
    const timeLimit = parseInt(localStorage.getItem('timeLimit') || '120');
    
    const elem = document.getElementById('screenTimeDisplay');
    if (elem) {
        elem.textContent = ` Watch time today: ${todayTime} / ${timeLimit} minutes`;
    }
}

// Initialize screen time display on page load
window.addEventListener('DOMContentLoaded', function() {
    updateScreenTime();
    // Update every 5 seconds
    setInterval(updateScreenTime, 5000);
});