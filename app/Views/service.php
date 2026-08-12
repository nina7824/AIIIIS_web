<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== SERVICE PAGE STYLES ========== */
.service-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 3rem 0 4rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.service-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
    pointer-events: none;
}
.service-hero .container {
    position: relative;
    z-index: 1;
}
.service-hero .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.7);
    margin-bottom: 1rem;
}
.service-hero .breadcrumb a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: var(--transition);
}
.service-hero .breadcrumb a:hover {
    color: #fff;
}
.service-hero .breadcrumb i {
    font-size: 0.6rem;
}
.service-hero .service-header {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
}
.service-hero .service-icon {
    width: 70px;
    height: 70px;
    border-radius: var(--radius);
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #fff;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,0.1);
}
.service-hero h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.3rem;
    letter-spacing: -0.02em;
}
.service-hero .service-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    padding: 0.25rem 1rem;
    border-radius: 100px;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 0.5rem;
}
.service-hero .service-description {
    font-size: 1rem;
    color: rgba(255,255,255,0.85);
    max-width: 32rem;
    line-height: 1.7;
    margin-top: 0.5rem;
}
@media (max-width: 640px) {
    .service-hero .service-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .service-hero h1 { font-size: 1.6rem; }
    .service-hero .service-description { max-width: 100%; }
}

/* ========== CHAT SECTION ========== */
.chat-section {
    padding: 2.5rem 0 4rem;
    background: var(--canvas);
}
.chat-container {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
    height: 600px;
    max-height: 70vh;
}
.chat-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--surface);
    flex-shrink: 0;
}
.chat-header .chat-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.chat-header .chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-weight: 700;
    font-size: 0.9rem;
}
.chat-header .chat-user-info h5 {
    font-size: 0.9rem;
    font-weight: 700;
    margin: 0;
}
.chat-header .chat-user-info .status {
    font-size: 0.65rem;
    color: var(--ink-muted);
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.chat-header .chat-user-info .status .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #22a67e;
    display: inline-block;
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}
.chat-header .chat-actions {
    display: flex;
    gap: 0.5rem;
}
.chat-header .chat-actions button {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius);
    transition: var(--transition);
}
.chat-header .chat-actions button:hover {
    background: var(--canvas);
    color: var(--ink);
}

.chat-messages {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    background: var(--canvas);
}
.chat-messages .message {
    max-width: 75%;
    padding: 0.75rem 1rem;
    border-radius: var(--radius);
    line-height: 1.5;
    font-size: 0.88rem;
    animation: messageSlideIn 0.3s ease;
}
@keyframes messageSlideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.chat-messages .message.user {
    background: var(--primary);
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 4px;
}
.chat-messages .message.support {
    background: var(--surface);
    border: 1px solid var(--border);
    color: var(--ink);
    align-self: flex-start;
    border-bottom-left-radius: 4px;
}
.chat-messages .message .message-time {
    font-size: 0.6rem;
    opacity: 0.6;
    display: block;
    margin-top: 0.25rem;
}
.chat-messages .message.support .message-time {
    color: var(--ink-muted);
}
.chat-messages .message.user .message-time {
    color: rgba(255,255,255,0.7);
}
.chat-messages .system-message {
    text-align: center;
    padding: 0.5rem 1rem;
    font-size: 0.75rem;
    color: var(--ink-muted);
    background: var(--surface);
    border-radius: 100px;
    align-self: center;
    border: 1px solid var(--border);
}

.chat-input-area {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border);
    background: var(--surface);
    display: flex;
    gap: 0.75rem;
    flex-shrink: 0;
}
.chat-input-area textarea {
    flex: 1;
    padding: 0.6rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    resize: none;
    font-family: inherit;
    font-size: 0.88rem;
    background: var(--canvas);
    color: var(--ink);
    transition: var(--transition);
    min-height: 44px;
    max-height: 120px;
}
.chat-input-area textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}
.chat-input-area .btn-send {
    padding: 0 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}
.chat-input-area .btn-send:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}
.chat-input-area .btn-send:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* ========== TYPING INDICATOR ========== */
.typing-indicator {
    background: var(--surface) !important;
    border: 1px solid var(--border) !important;
    color: var(--ink-muted) !important;
    font-size: 0.85rem !important;
    padding: 0.5rem 1rem !important;
}
.dot-typing {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--primary);
    animation: dotTyping 1.5s infinite ease-in-out;
}
.dot-typing:nth-child(1) { animation-delay: 0s; }
.dot-typing:nth-child(2) { animation-delay: 0.3s; }
.dot-typing:nth-child(3) { animation-delay: 0.6s; }
@keyframes dotTyping {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
    30% { transform: translateY(-6px); opacity: 1; }
}

/* ========== CONTACT BUTTONS ========== */
.contact-buttons-wrapper {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 1.5rem;
    justify-content: center;
}
.whatsapp-button {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.7rem 1.8rem;
    background: #25D366;
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    box-shadow: 0 4px 16px rgba(37, 211, 102, 0.3);
}
.whatsapp-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(37, 211, 102, 0.4);
    background: #20b858;
    color: #fff;
}
.whatsapp-button i {
    font-size: 1.1rem;
}
.email-button {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.7rem 1.8rem;
    background: #EA4335;
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    box-shadow: 0 4px 16px rgba(234, 67, 53, 0.3);
}
.email-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(234, 67, 53, 0.4);
    background: #d33426;
    color: #fff;
}
.email-button i {
    font-size: 1.1rem;
}
@media (max-width: 560px) {
    .contact-buttons-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    .whatsapp-button,
    .email-button {
        width: 100%;
        justify-content: center;
    }
}

/* ========== SERVICE FEATURES ========== */
.service-features-section {
    padding: 3rem 0;
    background: var(--surface);
    border-top: 1px solid var(--border);
}
.service-features-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
}
.service-feature-item {
    text-align: center;
    padding: 1.5rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    transition: var(--transition);
}
.service-feature-item:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
}
.service-feature-item .feature-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    color: var(--primary);
    font-size: 1rem;
}
.service-feature-item h5 {
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 0.2rem;
}
.service-feature-item p {
    font-size: 0.75rem;
    color: var(--ink-muted);
    margin: 0;
}
@media (max-width: 992px) {
    .service-features-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 560px) {
    .service-features-grid {
        grid-template-columns: 1fr;
    }
    .chat-container {
        height: 500px;
        max-height: 80vh;
    }
    .chat-messages .message {
        max-width: 90%;
    }
}

/* ========== BACK TO SERVICES ========== */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--ink-muted);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: var(--transition);
    margin-bottom: 1rem;
}
.back-link:hover {
    color: var(--primary);
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ========== SERVICE HERO ========== -->
<section class="service-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="<?= base_url() ?>#services">Services</a>
            <i class="fas fa-chevron-right"></i>
            <span><?= $service['title'] ?></span>
        </div>
        
        <div class="service-header">
            <div class="service-icon">
                <i class="fas <?= $service['icon'] ?>"></i>
            </div>
            <div>
                <div class="service-badge"><?= $service['badge'] ?></div>
                <h1><?= $service['title'] ?></h1>
                <p class="service-description"><?= $service['description'] ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ========== CHAT SECTION ========== -->
<section class="chat-section">
    <div class="container">
        <div class="chat-container">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-info">
                    <div class="chat-avatar">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="chat-user-info">
                        <h5>NIRDA Support Team</h5>
                        <span class="status">
                            <span class="dot"></span> 
                            <span id="supportStatus">Online — AI Powered Assistant</span>
                        </span>
                    </div>
                </div>
                <div class="chat-actions">
                    <button onclick="clearChat()" title="Clear chat">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button onclick="window.location.reload()" title="Refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div class="chat-messages" id="chatMessages">
                <div class="system-message">
                    <i class="fas fa-info-circle"></i> You are now connected to NIRDA support for <?= $service['title'] ?>
                </div>
                <div class="message support">
                    Hello! Welcome to <?= $service['title'] ?>. How can we assist you today?
                    <span class="message-time"><?= date('h:i A') ?></span>
                </div>
            </div>
            
            <!-- Chat Input -->
            <div class="chat-input-area">
                <textarea 
                    id="chatInput" 
                    rows="1" 
                    placeholder="<?= $service['chat_placeholder'] ?>"
                    onkeydown="if(event.key==='Enter' && !event.shiftKey){event.preventDefault();sendMessage();}"
                ></textarea>
                <button class="btn-send" onclick="sendMessage()" id="sendButton">
                    <i class="fas fa-paper-plane"></i> Send
                </button>
            </div>
        </div>

         <!-- ===== CONTACT BUTTONS ===== -->
        <?php
        // Define WhatsApp numbers for each service
        $whatsappNumbers = [
            'operations-followup' => '+250788503323',
            'business-advisor' => '+250781384024',
            'technical-support' => '+250782855821',
            'rd-services' => '+250725096670',
            'stem-services' => '+250792459886',
            'investor-matchmaking' => '+250796896034'
        ];
        
        // Define Email addresses for each service
        $emailAddresses = [
    'operations-followup' => 'amandin.mihigo@nirda.rw',  // ← Added @
    'business-advisor' => 'munyamboalvin04@gmail.com',
    'technical-support' => 'uwimbabaziange31@gmail.com',
    'rd-services' => 'evelynimutuyimana17@gmail.com',
    'stem-services' => 'ninaumukundwa@gmail.com',
    'investor-matchmaking' => 'rohschang@hanmail.net'
];
        
        $serviceId = $service['id'];
        $whatsappNumber = $whatsappNumbers[$serviceId] ?? '+250788503323';
        $emailAddress = $emailAddresses[$serviceId] ?? 'support@aiiiis.rw';
        
        $whatsappMessage = urlencode("Hello, I need assistance with " . $service['title'] . ". Can you help me?");
        $whatsappUrl = "https://wa.me/" . str_replace('+', '', $whatsappNumber) . "?text=" . $whatsappMessage;
        
        // Build Gmail compose URL
        $emailSubject = "Inquiry about " . $service['title'];
        $emailBody = "Hello,\n\nI hope this message finds you well. I am reaching out to inquire about the " . $service['title'] . " service.\n\nCould you please provide more information about the following:\n\n- [Your specific questions here]\n\nThank you for your assistance.\n\nBest regards,\n[Your Name]";
        
        // Gmail compose URL format
        $gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=" . urlencode($emailAddress) . "&su=" . urlencode($emailSubject) . "&body=" . urlencode($emailBody);
        ?>
        <div class="contact-buttons-wrapper">
            <a href="<?= $whatsappUrl ?>" target="_blank" class="whatsapp-button">
                <i class="fab fa-whatsapp"></i> WhatsApp Us
            </a>
            <a href="<?= $gmailUrl ?>" target="_blank" class="email-button">
                <i class="fas fa-envelope"></i> Email Us
            </a>
        </div>
    </div>
</section>

<!-- ========== SERVICE FEATURES ========== -->
<section class="service-features-section">
    <div class="container">
        <div class="section-header" style="margin-bottom: 2rem;">
            <div class="eyebrow">What's included</div>
            <h2>Service features</h2>
        </div>
        <div class="service-features-grid">
            <?php foreach ($service['features'] as $feature): ?>
            <div class="service-feature-item">
                <div class="feature-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h5><?= $feature ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Chat state
let serviceId = '<?= $service['id'] ?>';
let messageCount = 0;
const MAX_MESSAGES = 50;

// Auto-resize textarea
document.getElementById('chatInput').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Send message function - Uses AI Knowledge Base Only
function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    // Add user message to UI
    addMessage(message, 'user');
    
    // Clear input
    input.value = '';
    input.style.height = 'auto';
    document.getElementById('sendButton').disabled = true;
    
    // Show typing indicator
    addTypingIndicator();
    
    // Search knowledge base for answer
    const formData = new FormData();
    formData.append('service_id', serviceId);
    formData.append('message', message);
    
    fetch('<?= base_url("chatbot/process") ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Remove typing indicator
        removeTypingIndicator();
        
        if (data.success && data.reply) {
            // Display bot reply from knowledge base
            addMessage(data.reply, 'support');
        } else {
            // If no answer found, show default message
            const defaultReply = "I'm sorry, I don't have an answer for that question yet. Please contact us via WhatsApp or Email for more assistance.";
            addMessage(defaultReply, 'support');
        }
        document.getElementById('sendButton').disabled = false;
    })
    .catch(error => {
        // Remove typing indicator
        removeTypingIndicator();
        console.error('Error:', error);
        const errorReply = "I'm having trouble connecting to the knowledge base. Please try again later or contact us via WhatsApp or Email.";
        addMessage(errorReply, 'support');
        document.getElementById('sendButton').disabled = false;
    });
}

// Typing indicator functions
function addTypingIndicator() {
    const messagesContainer = document.getElementById('chatMessages');
    const typingDiv = document.createElement('div');
    typingDiv.className = 'message support typing-indicator';
    typingDiv.id = 'typingIndicator';
    typingDiv.innerHTML = `
        <span class="dot-typing"></span> NIRDA Assistant is typing...
        <span class="message-time">${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true })}</span>
    `;
    messagesContainer.appendChild(typingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function removeTypingIndicator() {
    const typingDiv = document.getElementById('typingIndicator');
    if (typingDiv) {
        typingDiv.remove();
    }
}

// Add message to chat
function addMessage(text, type) {
    const messagesContainer = document.getElementById('chatMessages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;
    
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit',
        hour12: true 
    });
    
    messageDiv.innerHTML = `
        ${text}
        <span class="message-time">${timeString}</span>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    messageCount++;
    
    // Limit messages
    if (messageCount > MAX_MESSAGES) {
        const messages = messagesContainer.querySelectorAll('.message');
        if (messages.length > MAX_MESSAGES) {
            messages[0].remove();
        }
    }
}

// Clear chat
function clearChat() {
    if (confirm('Clear all chat messages?')) {
        const messagesContainer = document.getElementById('chatMessages');
        messagesContainer.innerHTML = `
            <div class="system-message">
                <i class="fas fa-info-circle"></i> Chat cleared
            </div>
            <div class="message support">
                How can we help you with <?= $service['title'] ?>?
                <span class="message-time">${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true })}</span>
            </div>
        `;
        messageCount = 0;
    }
}

// Focus input on load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('chatInput').focus();
});
</script>
<?= $this->endSection() ?>