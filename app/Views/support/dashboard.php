<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== SUPPORT DASHBOARD STYLES ========== */
.support-dashboard {
    padding: 2rem 0;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}
.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    text-align: center;
    transition: var(--transition);
}
.stat-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
}
.stat-card .number {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary);
}
.stat-card .label {
    font-size: 0.85rem;
    color: var(--ink-muted);
}
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 1.5rem;
}
.sessions-panel {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    max-height: 600px;
    overflow-y: auto;
}
.sessions-panel h4 {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}
.chat-panel {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    height: 600px;
}
.chat-panel .chat-header {
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
    margin-bottom: 0.75rem;
}
.chat-panel .chat-header h4 {
    margin: 0;
}
.chat-panel .chat-header small {
    color: var(--ink-muted);
}
.chat-messages-area {
    flex: 1;
    overflow-y: auto;
    padding: 0.5rem;
    background: var(--canvas);
    border-radius: var(--radius);
    margin-bottom: 0.75rem;
}
.chat-messages-area .msg {
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius);
    margin-bottom: 0.5rem;
    max-width: 85%;
}
.chat-messages-area .msg.user {
    background: var(--primary);
    color: #fff;
    margin-left: auto;
}
.chat-messages-area .msg.support {
    background: var(--surface);
    border: 1px solid var(--border);
    margin-right: auto;
}
.chat-messages-area .msg .time {
    font-size: 0.6rem;
    opacity: 0.7;
    margin-top: 0.2rem;
    display: block;
}
.chat-messages-area .msg.user .time {
    color: rgba(255,255,255,0.7);
}
.chat-messages-area .empty-state {
    text-align: center;
    color: var(--ink-muted);
    padding: 2rem;
}
.chat-messages-area .empty-state i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: var(--primary-light);
}
.reply-area {
    display: flex;
    gap: 0.5rem;
}
.reply-area textarea {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    resize: none;
    font-family: inherit;
    min-height: 50px;
    transition: var(--transition);
}
.reply-area textarea:focus {
    outline: none;
    border-color: var(--primary);
}
.reply-area button {
    padding: 0.5rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}
.reply-area button:hover {
    background: var(--primary-dark);
}
.reply-area button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
.session-item {
    padding: 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: 0.5rem;
    cursor: pointer;
    transition: var(--transition);
}
.session-item:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}
.session-item.active {
    border-color: var(--primary);
    background: var(--primary-light);
}
.session-item .session-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.session-item .session-id {
    font-weight: 600;
    font-size: 0.85rem;
}
.session-item .session-meta {
    font-size: 0.7rem;
    color: var(--ink-muted);
}
.session-item .unread-badge {
    background: #e74c3c;
    color: #fff;
    padding: 0.1rem 0.5rem;
    border-radius: 100px;
    font-size: 0.65rem;
    font-weight: 600;
}
.session-item .service-tag {
    background: var(--primary-light);
    color: var(--primary-dark);
    padding: 0.1rem 0.5rem;
    border-radius: 100px;
    font-size: 0.6rem;
    font-weight: 500;
}
@media (max-width: 992px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 560px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    .reply-area {
        flex-direction: column;
    }
    .reply-area button {
        width: 100%;
        padding: 0.75rem;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="support-dashboard">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Support Dashboard</h2>
            <div>
                <button onclick="refreshData()" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <div class="number" id="totalSessions">0</div>
                <div class="label">Active Sessions</div>
            </div>
            <div class="stat-card">
                <div class="number" id="totalMessages">0</div>
                <div class="label">Total Messages</div>
            </div>
            <div class="stat-card">
                <div class="number" id="unreadCount">0</div>
                <div class="label">Unread Messages</div>
            </div>
            <div class="stat-card">
                <div class="number" id="unansweredCount">0</div>
                <div class="label">Unanswered Questions</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Sessions Panel -->
            <div class="sessions-panel">
                <h4>Sessions <span id="sessionCount" class="badge badge-secondary">0</span></h4>
                <div id="sessionsList">
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-spinner fa-spin"></i> Loading sessions...
                    </div>
                </div>
            </div>

            <!-- Chat Panel -->
            <div class="chat-panel" id="chatPanel">
                <div class="chat-header">
                    <h4 id="chatTitle">Select a session</h4>
                    <small id="chatSubtitle">Click on a session to view messages</small>
                </div>
                <div class="chat-messages-area" id="chatMessagesArea">
                    <div class="empty-state">
                        <i class="fas fa-comment-dots"></i>
                        <p>Select a session to view messages</p>
                    </div>
                </div>
                <div class="reply-area" id="replyArea" style="display: none;">
                    <textarea id="replyInput" rows="2" placeholder="Type your reply..." onkeydown="if(event.key==='Enter' && !event.shiftKey){event.preventDefault();sendReply();}"></textarea>
                    <button onclick="sendReply()" id="sendReplyBtn">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let currentSessionId = null;
let currentServiceId = null;
let pollingInterval = null;

// Load sessions
function loadSessions() {
    fetch('<?= base_url("support/getSessions") ?>')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const sessionsList = document.getElementById('sessionsList');
            document.getElementById('sessionCount').textContent = data.sessions.length;
            
            if (data.sessions.length === 0) {
                sessionsList.innerHTML = `
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-inbox"></i>
                        <p class="mt-2">No active sessions</p>
                    </div>
                `;
                return;
            }
            
            let html = '';
            data.sessions.forEach(session => {
                const unreadBadge = session.unread_count > 0 
                    ? `<span class="unread-badge">${session.unread_count} new</span>` 
                    : '';
                const isActive = currentSessionId === session.session_id ? 'active' : '';
                const userName = session.user_name || (session.user_id ? `User #${session.user_id}` : 'Guest');
                const timeAgo = session.last_message_time ? new Date(session.last_message_time).toLocaleString() : '';
                
                html += `
                    <div class="session-item ${isActive}" onclick="loadSession('${session.session_id}')">
                        <div class="session-info">
                            <span class="session-id">${userName}</span>
                            ${unreadBadge}
                        </div>
                        <div class="session-meta">
                            <span class="service-tag">${session.service_id}</span>
                            ${session.last_message_text ? session.last_message_text.substring(0, 50) + '...' : 'No messages'}
                            <br>
                            <small>${timeAgo}</small>
                        </div>
                    </div>
                `;
            });
            sessionsList.innerHTML = html;
        }
    })
    .catch(error => console.error('Error loading sessions:', error));
}

// Load session messages
function loadSession(sessionId) {
    currentSessionId = sessionId;
    
    // Update UI
    document.querySelectorAll('.session-item').forEach(el => el.classList.remove('active'));
    const activeItem = document.querySelector(`.session-item[onclick="loadSession('${sessionId}')"]`);
    if (activeItem) {
        activeItem.classList.add('active');
    }
    
    // Show reply area
    document.getElementById('replyArea').style.display = 'flex';
    document.getElementById('chatTitle').textContent = 'Session: ' + sessionId.substring(0, 20) + '...';
    document.getElementById('chatSubtitle').textContent = 'Loading messages...';
    document.getElementById('chatMessagesArea').innerHTML = '<div class="text-center text-muted py-3"><i class="fas fa-spinner fa-spin"></i> Loading messages...</div>';
    
    fetch(`<?= base_url("support/getSessionMessages/") ?>${encodeURIComponent(sessionId)}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const messagesArea = document.getElementById('chatMessagesArea');
            const messages = data.messages;
            
            if (messages.length === 0) {
                messagesArea.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-comment-dots"></i>
                        <p>No messages in this session</p>
                    </div>
                `;
                document.getElementById('chatSubtitle').textContent = 'No messages';
                return;
            }
            
            let html = '';
            messages.forEach(msg => {
                const senderClass = msg.sender_type === 'user' ? 'user' : 'support';
                const time = new Date(msg.created_at).toLocaleTimeString();
                const senderName = msg.sender_type === 'user' ? '👤 User' : '👨‍💼 Support';
                html += `
                    <div class="msg ${senderClass}">
                        <strong>${senderName}:</strong> ${msg.message}
                        <span class="time">${time}</span>
                    </div>
                `;
            });
            
            messagesArea.innerHTML = html;
            messagesArea.scrollTop = messagesArea.scrollHeight;
            document.getElementById('chatSubtitle').textContent = `${messages.length} messages`;
            
            // Get service_id from first message
            if (messages.length > 0) {
                currentServiceId = messages[0].service_id;
            }
        } else {
            document.getElementById('chatMessagesArea').innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Error loading messages</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading messages:', error);
        document.getElementById('chatMessagesArea').innerHTML = `
            <div class="empty-state">
                <i class="fas fa-exclamation-circle"></i>
                <p>Error loading messages</p>
            </div>
        `;
    });
}

// Send reply
function sendReply() {
    const input = document.getElementById('replyInput');
    const message = input.value.trim();
    
    if (!message || !currentSessionId) {
        alert('Please select a session and type a message.');
        return;
    }
    
    const sendBtn = document.getElementById('sendReplyBtn');
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    
    const formData = new FormData();
    formData.append('session_id', currentSessionId);
    formData.append('message', message);
    formData.append('service_id', currentServiceId || 'general');
    
    fetch('<?= base_url("support/sendReply") ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            // Reload messages
            loadSession(currentSessionId);
            // Reload sessions to update unread counts
            loadSessions();
        } else {
            alert('Failed to send reply: ' + (data.error || 'Unknown error'));
        }
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to send reply.');
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send';
    });
}

// Load stats
function loadStats() {
    fetch('<?= base_url("support/getStats") ?>')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('totalSessions').textContent = data.stats.total_sessions;
            document.getElementById('totalMessages').textContent = data.stats.total_messages;
            document.getElementById('unreadCount').textContent = data.stats.unread_count;
            document.getElementById('unansweredCount').textContent = data.stats.unanswered_count;
        }
    })
    .catch(error => console.error('Error loading stats:', error));
}

// Refresh data
function refreshData() {
    loadStats();
    loadSessions();
    if (currentSessionId) {
        loadSession(currentSessionId);
    }
}

// Start polling for new messages every 3 seconds
function startPolling() {
    if (pollingInterval) clearInterval(pollingInterval);
    
    pollingInterval = setInterval(() => {
        refreshData();
    }, 3000);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadStats();
    loadSessions();
    startPolling();
});

// Cleanup
window.addEventListener('beforeunload', function() {
    if (pollingInterval) {
        clearInterval(pollingInterval);
    }
});
</script>
<?= $this->endSection() ?>