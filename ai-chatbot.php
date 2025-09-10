<?php 
session_start(); // Add this at the very top
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EZfinance: AI Assistant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <input type="hidden" id="isLoggedIn" value="<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>">
    <style>
        * {
            text-decoration: white;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .chatbot-container {
            background-color: #1B263B;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .chatbot-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .chatbot-messages {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #415A77;
            border-radius: 8px;
            padding: 10px;
            background-color: #0D1B2A;
            color: rgb(255, 255, 255);;
        }

        .message {
            background-color:rgb(61, 92, 127);
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            color: rgb(255, 255, 255);
        }

        .user-messages {
            /* color:rgb(255, 255, 255); */
            text-align: right;
            background-color: #415A77;
            text-align: right;
            
        }

       

        .chatbot-form {
            display: flex;
            margin-top: 20px;
        }

        .chatbot-input {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #415A77;
            margin-right: 10px;
            background-color: #0D1B2A;
            color: white;
        }

        .chatbot-button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background-color: #415A77;
            color: white;
            cursor: pointer;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #1B263B;
            overflow-x: hidden;
            padding-top: 60px;
            transition: 0.5s;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            color: white;
            display: block;
            transition: 0.3s;
            cursor: pointer;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background-color: #1B263B;
            color: white;
            cursor: pointer;
            
            top: 10px;
            left: 10px;
        }

        .openbtn:hover {
            background-color: #415A77;
        }

        .dropdown-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        #main {
            transition: margin-left .5s;
            padding: 20px;
        }

        .dropdown-list {
            display: none;
            background-color: #1B263B;
            margin-left: 20px;
        }

        .dropdown-list a {
            padding: 8px 32px;
            text-decoration: none;
            color: white;
        }

        .dropdown-list a:hover {
            background-color: #415A77;
        }

        .sidebar .active .dropdown-list {
            display: block;
        }

        /* Fix for chatbot visibility */
        #chat-container {
            margin-left: 0; /* Prevent the margin from shifting when sidebar is open */
            transition: margin-left 0.5s;
            position: relative;
            z-index: 2;
        }

        /* Make sure the chatbot stays visible */
        .sidebar-open #chat-container {
            margin-left: 250px; /* Shift the content slightly when sidebar is open */
        }
        .chatbot-button {
    background-color: #7FA8D8;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.chatbot-button i {
    color: #0F2D4D;
    font-size: 20px;
    position: absolute;
}

.listening-dots {
    display: none;
    position: absolute;
    bottom: -20px; /* Below the mic icon */
    font-size: 10px;
    color: #0F2D4D;
    letter-spacing: 3px;
    animation: wave 1.5s infinite ease-in-out;
}

@keyframes wave {
    0% { opacity: 0.3; transform: translateY(0); }
    50% { opacity: 1; transform: translateY(-3px); }
    100% { opacity: 0.3; transform: translateY(0); }
}

/* Show dots when active */
.chatbot-button.listening .listening-dots {
    display: block;
}

.ezfinance-send-button {
    background-color:  #7FA8D8; /* EZfinance green theme */
    color: #fff; /* White text for contrast */
    border: none;
    border-radius: 25px; /* Rounded corners for a modern look */
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow for depth */
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.ezfinance-send-button:hover {
    background-color: #415A77; /* Slightly darker green for hover effect */
    transform: scale(1.05); /* Slight pop-out effect */
}

.ezfinance-send-button:active {
    background-color: #415A77; /* Deeper green on click */
    transform: scale(0.95); /* Slight press-in effect */
}
/* Stylish Logout Button */
.Btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 45px;
    height: 45px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition-duration: .3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
    background-color: #7FA8D8;
}

.sign {
    width: 100%;
    transition-duration: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sign svg {
    width: 17px;
}

.sign svg path {
    fill: white;
}

.text {
    position: absolute;
    right: 0%;
    width: 0%;
    opacity: 0;
    color: white;
    font-size: 1.2em;
    font-weight: 600;
    transition-duration: .3s;
}

.Btn:hover {
    width: 125px;
    border-radius: 40px;
    transition-duration: .3s;
}

.Btn:hover .sign {
    width: 30%;
    transition-duration: .3s;
    padding-left: 20px;
}

.Btn:hover .text {
    opacity: 1;
    width: 70%;
    transition-duration: .3s;
    padding-right: 10px;
}

.Btn:active {
    transform: translate(2px, 2px);
}



    </style>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js@6.6.2/dist/fuse.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.html"><b class="EZ">EZ</b><i>f</i>inance</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link nbtn" href="index.html"><b>Home</b></a></li>
                <!-- <li class="nav-item"><a class="nav-link nbtn" href="features.html"><b>Our Features</b></a></li> -->
                <li class="nav-item"><a class="nav-link nbtn" href="about.html"><b>About us</b></a></li>
                <!-- <li class="nav-item"><a class="nav-link nbtn" href="services.html"><b>Services</b></a></li> -->
                <!-- <li class="nav-item"><a class="nav-link nbtn" href="blog.html"><b>Blog</b></a></li> -->
                <!-- <li class="nav-item"><a class="nav-link nbtn" href="courses.html"><b>Learn Finance</b></a></li> -->
                <li class="nav-item"><a class="nav-link nbtn" href="ai-chatbot.php" style="text-decoration: underline;"><b>AI Assistant</b></a></li>
            </ul>
        </div>
    </nav><br>
<div>
    <button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="expense_tracker.php" target="_blank"><big>Expense Tracker</big></a>
        <a href="news.html" target="_blank" ><big>Latest Finance related news</big></a>
        
        <a href="javascript:void(0)" class="sidebar-item" onclick="toggleDropdown('dropdown1')"><big>Financial Calculations</big></a>
        <div id="dropdown1" class="dropdown-list">
            <a href="simpleinterest.html" target="_blank">Calculate Simple Interest</a>
            <a href="emi.html" target="_blank">Calculate EMI</a>
            <a href="tax.html" target="_blank">Calculate Tax</a>
            <a href="sip.html" target="_blank">Calculate SIP</a>
        </div>
        <a href="currency.html" target="_blank"><big>Currency Converter</big></a>
        <a href="whatsappassistant.html" target="_blank"><big>EZfinance Whatsapp Assistant</big></a>
        <br><br><br><br><br><br><br><br>
<?php 


if(isset($_SESSION['username'])): ?>
    <form id="logoutForm" action="logout.php" method="POST">
        <!-- From Uiverse.io by MUJTABA201566 --> 
<button type="button" class="Btn" onclick="confirmLogout()">
  <div class="sign">
    <svg viewBox="0 0 512 512">
      <path
        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
      ></path>
    </svg>
  </div>

  <div class="text">Logout</div>
</button>

    </form>
<?php endif; ?>

        </div>
    </div>
</div>
    <div class="container">
        <!-- Chatbot UI -->
        <div class="chatbot-container">
            <div class="chatbot-header">
                <h2><b class="EZ">EZ</b><i>f</i>inance AI Chatbot</h2>
                <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> ! I'm Your Personal AI-Powered Financial Advisor, you can ask me anything about your finance...</p>
                
            </div>
            <div id="chatbot-messages" class="chatbot-messages">
                <!-- Chat messages will be inserted here -->
            </div>
            <form id="chatbot-form" class="chatbot-form">
                <input type="text" id="chatbot-input" class="chatbot-input" placeholder="Type your question here..." required>
                <button type="submit" class="ezfinance-send-button">Send</button>
                <button type="button" class="chatbot-button" id="micButton" onclick="startVoiceRecognition()">
                    <i class="fas fa-microphone"></i>
                </button>
            </form>
        </div><br><br>
    </div><br><br><br>

    <footer>
        <p>&copy; 2025 EZfinance. All Rights Reserved. | <a href="feedback.html">Give Feedback</a></p>
    </footer>
    

    <!-- Include Bootstrap JS and custom JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="chatbot.js"></script>
    <script>
    function confirmLogout() {
        const confirmationBox = document.createElement("div");
        confirmationBox.className = "confirmation-box";
        confirmationBox.innerHTML = `
            <div class="confirmation-content">
                 <p style="color: #000; font-weight: bold; font-size: 18px;">
                    Do you want to logout?
                </p>
                <div class="confirmation-actions">
                    <button id="confirmLogoutBtn">Logout</button>
                    <button id="cancelLogoutBtn">Cancel</button>
                </div>
            </div>
        `;

        // Styling for the popup
        Object.assign(confirmationBox.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            zIndex: '9999'
        });

        const contentStyle = confirmationBox.querySelector('.confirmation-content').style;
        Object.assign(contentStyle, {
            backgroundColor: '#fff',
            padding: '20px',
            borderRadius: '12px',
            textAlign: 'center',
            boxShadow: '0 4px 15px rgba(0, 0, 0, 0.3)',
            width: '320px'
        });

        const buttonStyle = {
            padding: '8px 20px',
            borderRadius: '6px',
            border: 'none',
            cursor: 'pointer',
            margin: '0 10px'
        };

        Object.assign(confirmationBox.querySelector('#confirmLogoutBtn').style, {
            ...buttonStyle,
            backgroundColor: '#dc3545',
            color: '#fff'
        });

        Object.assign(confirmationBox.querySelector('#cancelLogoutBtn').style, {
            ...buttonStyle,
            backgroundColor: '#6c757d',
            color: '#fff'
        });

        document.body.appendChild(confirmationBox);

        // Logout button action
        document.getElementById('confirmLogoutBtn').onclick = function () {
            document.getElementById('logoutForm').submit();
        };

        // Cancel button action
        document.getElementById('cancelLogoutBtn').onclick = function () {
            confirmationBox.remove();
        };
    }
</script>




<script>
    document.getElementById("chatbot-form").addEventListener("submit", async function (e) {
        e.preventDefault();

        const input = document.getElementById("chatbot-input");
        const message = input.value.trim();
        if (!message) return;

        const messages = document.getElementById("chatbot-messages");
        messages.innerHTML += `<div class="message user"><strong>You:</strong> ${message}</div>`;
        input.value = "";

        try {
            const response = await fetch("http://127.0.0.1:5000/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            const source = data.source === "ezfinance" ? " (EZfinance)" : " (Gemini)";
            const reply = `<div class="message bot"><strong>Bot${source}:</strong> ${data.response}</div>`;
            messages.innerHTML += reply;
            messages.scrollTop = messages.scrollHeight;
        } catch (err) {
            messages.innerHTML += `<div class="message bot error"><strong>Bot:</strong> Error connecting to the server.</div>`;
        }
    });
</script>







<script src="authCheck.js"></script>



 
</body>
</html>
