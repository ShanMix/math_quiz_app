<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Math Quiz </title>
<style>
 /* =========== DARK BLUE MATH THEME ============== */
:root {
    --primary-bg: #0F172A;
    --secondary-bg: #1E293B;
    --accent: #38BDF8;
    --text: #E2E8F0;
    --text-muted: #94A3B8;
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background: var(--primary-bg);
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: var(--text);
}

.container {
    background: var(--secondary-bg);
    width: 800px;
    max-width: 95%;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    position: relative;
    border: 1px solid #2D3A4F;
}

h1, h2, h3 {
    text-align: center;
    color: var(--text);
    margin-top: 0;
}

h1 {
    margin: 20px;
}

/* ===== INPUTS ===== */
input {
    padding: 12px 15px;
    width: 100%;
    margin: 10px 0;
    border-radius: 30px;
    border: 1px solid #334155;
    background: #0F172A;
    color: var(--text);
    font-size: 14px;
    transition: border-color 0.2s;
}

input:focus {
    border-color: var(--accent);
    outline: none;
}

input::placeholder {
    color: #64748B;
}

/* ===== BUTTONS ===== */
button {
    padding: 12px 20px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-weight: bold;
    background: var(--accent);
    color: #0F172A;
    transition: transform 0.2s, background 0.3s;
    font-size: 16px;
}

button:hover {
    transform: scale(1.05);
    background: #7AC9FF;
}

.quit-btn {
    position: absolute;
    top: 15px;
    right: 25px;
    background: #475569;
    color: var(--text);
    padding: 8px 15px;
    font-size: 14px;
}

.quit-btn:hover {
    background: #5F6B7F;
}

/* ===== LINKS ===== */
.link {
    color: var(--accent);
    cursor: pointer;
    text-decoration: underline;
    font-size: 14px;
}

.link:hover {
    color: #7AC9FF;
}

/* ===== LOGIN / SIGNUP SCREENS ===== */
#loginScreen, #signupScreen {
    width: 380px;
    margin: 0 auto;
    padding: 20px 10px;
    border-radius: 10px;
    text-align: center;
}

#signupScreen {
    padding: 40px 30px;
}

#signupScreen .subtitle {
    font-size: 14px;
    margin-bottom: 30px;
    color: var(--text-muted);
}

/* ===== PASSWORD STRENGTH METER ===== */
.strength-meter {
    margin-top: 5px;
    margin-bottom: 15px;
    padding: 8px;
    border-radius: 30px;
    text-align: center;
    font-weight: bold;
    transition: background 0.3s, color 0.3s;
}
.strength-0 { background-color: #f44336; color: white; } /* Too Weak */
.strength-1 { background-color: #ff9800; color: white; } /* Weak */
.strength-2 { background-color: #ffeb3b; color: black; } /* Medium */
.strength-3 { background-color: #4caf50; color: white; } /* Strong */
.strength-4 { background-color: #006400; color: white; } /* Very Strong */

/* ===== PASSWORD REQUIREMENTS LIST ===== */
.requirements {
    text-align: left;
    margin: 10px 0 15px 0;
    padding: 10px;
    background: #0F172A;
    border-radius: 10px;
    border: 1px solid #334155;
}
.requirements p {
    margin: 5px 0;
    font-size: 13px;
    color: var(--text-muted);
}
.requirements .valid {
    color: #4ADE80;
}
.requirements .invalid {
    color: #F87171;
}

/* ===== SHOW PASSWORD TOGGLE BUTTON ===== */
.password-toggle {
    margin: 10px 0;
    text-align: left;
}
.password-toggle button {
    background: transparent;
    border: 1px solid #334155;
    color: var(--text);
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 30px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.password-toggle button:hover {
    background: #1E293B;
    transform: none;
    border-color: var(--accent);
}

/* ===== OPTIONS CONTAINER (quiz answers) ===== */
#optionsContainer {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    max-width: 350px;
    margin: 0 auto;
}

#optionsContainer button {
    padding: 20px;
    font-size: 22px;
    border-radius: 15px;
    font-weight: bold;
    background: #0F172A;
    color: var(--text);
    border: 2px solid #334155;
    transition: all 0.2s;
}

#optionsContainer button:hover {
    border-color: var(--accent);
    background: #1E293B;
    transform: scale(1.02);
}

#optionsContainer button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* ===== ANSWER OVERLAY ===== */
.answer-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 15px;
    z-index: 10;
}

.answer-box {
    text-align: center;
    padding: 40px;
    background: var(--secondary-bg);
    border-radius: 20px;
    border: 2px solid var(--accent);
}

.answer-icon {
    font-size: 60px;
    margin-bottom: 20px;
    color: var(--accent);
}

.answer-title {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--text);
}

.answer-text {
    font-size: 18px;
    color: var(--text-muted);
}

/* ===== NEW DASHBOARD (stat boxes) ===== */
.dashboard {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.stat-box {
    background: #0F172A;
    border: 1px solid #334155;
    border-radius: 12px;
    padding: 12px 10px;
    min-width: 100px;
    text-align: center;
    flex: 1 1 0; /* all boxes equal width */
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
}

.stat-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-muted);
    margin-bottom: 5px;
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
    color: var(--accent);
    line-height: 1.2;
}

/* ===== PROGRESS BAR ===== */
.progress-bar {
    width: 100%;
    height: 10px;
    background: #334155;
    border-radius: 10px;
    margin-top: 10px;
}

.progress {
    height: 10px;
    background: var(--accent);
    width: 0%;
    border-radius: 10px;
    transition: width 0.5s;
}

/* ===== QUESTION AREA ===== */
.question-area {
    margin: 30px 0;
    padding: 30px 20px;
    border-radius: 20px;
    text-align: center;
    background: #0F172A;
    border: 1px solid #334155;
}

#question {
    font-size: 60px;
    font-weight: bold;
    margin-bottom: 30px;
    color: var(--text);
}

.feedback {
    font-weight: bold;
    margin-top: 10px;
}

.correct {
    color: #4ADE80;
}

.wrong {
    color: #F87171;
}

/* ===== SUMMARY DASHBOARD ===== */
.dashboard-summary {
    background: var(--secondary-bg);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    border: 1px solid #334155;
}

.dashboard-summary h2 {
    color: var(--text);
    margin-bottom: 20px;
    font-size: 28px;
    border-bottom: 3px solid var(--accent);
    padding-bottom: 10px;
}

.summary-card {
    background: linear-gradient(135deg, #1E293B, #0F172A);
    color: var(--text);
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 25px;
    border: 1px solid var(--accent);
}

.summary-card strong {
    font-size: 24px;
    display: block;
    margin-bottom: 15px;
    text-align: center;
    color: var(--accent);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-top: 15px;
}

.stat-item {
    background: #0F172A;
    padding: 12px;
    border-radius: 10px;
    text-align: center;
    border: 1px solid #334155;
}

.stat-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-muted);
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
    margin-top: 5px;
    color: var(--accent);
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
    flex-wrap: wrap;
}

.action-buttons button {
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--accent);
    color: #0F172A;
}

.btn-primary:hover {
    background: #7AC9FF;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(56, 189, 248, 0.3);
}

.btn-warning {
    background: #F59E0B;
    color: #0F172A;
}

.btn-warning:hover {
    background: #FBBF24;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
}

.btn-secondary {
    background: #475569;
    color: var(--text);
}

.btn-secondary:hover {
    background: #5F6B7F;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(71, 85, 105, 0.3);
}

/* ===== MODAL ===== */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
}

.modal-content {
    background: var(--secondary-bg);
    margin: 15% auto;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    border: 1px solid var(--accent);
}

.modal-content h3 {
    color: var(--text);
    margin-top: 0;
}

.modal-buttons {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* ===== WELCOME SCREEN START BUTTON ===== */
#welcomeScreen button {
    padding: 15px 50px;
    border-radius: 30px;
    font-size: 18px;
    background: var(--accent);
    color: #0F172A;
}

#welcomeScreen button:hover {
    background: #7AC9FF;
}

/* ===== DIFFICULTY SCREEN ===== */
#difficultyScreen {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

#difficultyScreen button {
    padding: 15px 40px;
    font-size: 18px;
}
</style>
</head>
<body>
<div class="container">

<button id="quitBtn" class="quit-btn" style="display:none;" onclick="quitGame()">Quit</button>

<h1> Math Quiz </h1>

<!-- LOGIN SCREEN -->
<div id="loginScreen">

    <h2> LOGIN </h2>
    <input type="text" id="loginUsername" placeholder="Enter your username">
    <input type="password" id="loginPassword" placeholder="Password">

    <!-- Show password toggle for login (eye icon) -->
    <div class="password-toggle">
        <button type="button" id="toggleLoginPasswordBtn">👁 Show password</button>
    </div>

    <button onclick="login()">Sign In</button>

    <p style="margin-top:20px;">
        <span class="link" onclick="showSignup()">Don't have an account? Sign Up</span><br><br>
        <span class="link" onclick="showGuestModal()">Continue as Guest</span>
    </p>
</div>

<!-- SIGNUP SCREEN -->
<div id="signupScreen" style="display:none;">
    <h3>Create Account</h3>
    <div class="subtitle">Register to start your quiz journey</div>

    <input type="text" id="signupUsername" placeholder="Choose a username">

    <!-- Password field -->
    <input type="password" id="signupPassword" placeholder="Create a password">

    <!-- Re-enter password field -->
    <input type="password" id="signupRePassword" placeholder="Re-enter password">

    <!-- Show password toggle for signup (eye icon) -->
    <div class="password-toggle">
        <button type="button" id="toggleSignupPasswordBtn">👁 Show passwords</button>
    </div>

    <!-- Password strength meter -->
    <div id="passwordStrength" class="strength-meter strength-0">Too Weak</div>

    <!-- Password requirements list -->
    <div class="requirements" id="passwordRequirements">
        <p id="reqLength" class="invalid">❌ At least 8 characters</p>
        <p id="reqLower" class="invalid">❌ Lowercase letter</p>
        <p id="reqUpper" class="invalid">❌ Uppercase letter</p>
        <p id="reqDigit" class="invalid">❌ Number</p>
        <p id="reqSymbol" class="invalid">❌ Special character (!@#$%^&*)</p>
        <p id="reqMatch" class="invalid">❌ Passwords match</p>
    </div>

    <button onclick="signup()">Register</button>

    <p style="margin-top:20px;">
        <span class="link" onclick="showLogin()">Already have an account? Back to Login</span>
    </p>
</div>

<!-- GUEST MODAL -->
<div id="guestModal" class="modal">
    <div class="modal-content">
        <h3>Enter Name</h3>
        <input type="text" id="guestNameInput" placeholder="Your name"><br>
        <div class="modal-buttons">
            <button onclick="submitGuestName()">Start Quiz</button>
            <button onclick="closeGuestModal()">Cancel</button>
        </div>
    </div>
</div>

<div id="welcomeScreen" style="display:none; text-align:center;">
    <h2 style="margin-bottom:10px;">Hello, <span id="welcomeUser"></span>!</h2>

    <!-- Recent Games section (only shown for registered users) -->
    <div id="recentGamesSection" style="margin: 30px 0; text-align: left; background: #0F172A; padding: 20px; border-radius: 15px; border: 1px solid #334155;">
        <h3 style="color: var(--accent); margin-top:0;">📋 Recent Games</h3>
        <div id="recentGamesList">
            <!-- Will be populated by JavaScript -->
            <p style="color: var(--text-muted); text-align:center;">Loading...</p>
        </div>
    </div>

    <!-- START and LOGOUT buttons -->
    <div style="display: flex; justify-content: center; gap: 20px;">
        <button onclick="goToDifficulty()" style="padding: 15px 50px; font-size: 18px;">START</button>
        <button onclick="logout()" class="btn-secondary" style="padding: 15px 30px; font-size: 18px;">Logout</button>
    </div>
</div>


<!-- DIFFICULTY SELECTION -->
<div id="difficultyScreen" style="display:none; text-align:center;">
    <h3>Select Difficulty</h3>
    <button onclick="startQuizWithDifficulty('easy')">Easy</button>
    <button onclick="startQuizWithDifficulty('medium')">Medium</button>
    <button onclick="startQuizWithDifficulty('hard')">Hard</button>
</div>

<!-- QUIZ SCREEN -->
<div id="quizScreen" style="display:none;">
    <!-- New stat boxes layout -->
    <div class="dashboard">
        <div class="stat-box">
            <div class="stat-label">USERNAME</div>
            <div class="stat-value" id="playerNameDisplay">-</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">SCORE</div>
            <div class="stat-value" id="scoreDisplay">0</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">TIME LEFT</div>
            <div class="stat-value" id="timeDisplay">10s</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">PROGRESS</div>
            <div class="stat-value" id="progressDisplay">0/10</div>
        </div>
    </div>
    <div class="progress-bar"><div class="progress" id="progressBar"></div></div>
    <div class="question-area">
        <div id="question"></div>
        <div id="optionsContainer" style="margin-top:15px;"></div>
        <div class="feedback" id="feedback"></div>
    </div>
</div>

<!-- ================= DASHBOARD SUMMARY ================= -->
<div class="dashboard-summary" id="summary" style="display:none;">
    <h2>📊 Quiz Dashboard</h2>

    <!-- Player Stats Card -->
    <div class="summary-card">
        <strong>🏆 <span id="finalPlayer"></span>'s Results</strong>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-label">Final Score</div>
                <div class="stat-value" id="finalScore">0</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Points</div>
                <div class="stat-value" id="finalPoints">0</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Correct</div>
                <div class="stat-value" id="finalCorrect">0</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Wrong</div>
                <div class="stat-value" id="finalWrong">0</div>
            </div>
            <div class="stat-item" style="grid-column: span 2;">
                <div class="stat-label">Accuracy</div>
                <div class="stat-value" id="finalAccuracy">0</div>
            </div>
        </div>
    </div>

    <!-- Action Buttons (added Home button) -->
    <div class="action-buttons">
        <button class="btn-primary" onclick="retryQuiz()">🔄 Play Again</button>
        <button class="btn-warning" onclick="backToDifficulty()">⚙️ Change Difficulty</button>
        <button class="btn-secondary" onclick="goToWelcome()">🏠 Home</button>
        <button class="btn-secondary" onclick="logout()">🚪 Logout</button>
    </div>
</div>

<script>
let player="", difficulty="easy";
let totalQuestions=10, currentQuestionIndex=0, score=0, timeLeft=10, timer;
let currentAnswer=0, correctCount=0, wrongCount=0;
let userAnswers=[], questionHistory=[];

/* LOGIN/SIGNUP/GUEST FLOW */
function showSignup(){ document.getElementById("loginScreen").style.display="none"; document.getElementById("signupScreen").style.display="block";}
function showLogin(){ document.getElementById("signupScreen").style.display="none"; document.getElementById("loginScreen").style.display="block"; }
function login(){
    const username = document.getElementById("loginUsername").value.trim();
    const password = document.getElementById("loginPassword").value;

    if(!username || !password){ alert("Enter username & password"); return; }

    fetch('login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            player = username;
           showWelcomeScreen();
        } else {
            alert(data.message || "Login failed");
        }
    });
}
function signup(){
    const username = document.getElementById("signupUsername").value.trim();
    const password = document.getElementById("signupPassword").value;
    const repassword = document.getElementById("signupRePassword").value;

    if(!username || !password){
        alert("Enter username & password");
        return;
    }

    // Check if passwords match
    if(password !== repassword){
        alert("Passwords do not match!");
        return;
    }

    // Optional: enforce minimum strength before submitting
    // You can uncomment the next lines to require at least Medium strength
    // const strength = evaluatePasswordStrength(password, username);
    // if(strength < 2) {
    //     alert("Please choose a stronger password (at least Medium).");
    //     return;
    // }

    fetch('register.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert("Account registered successfully!");
            showLogin();
        } else {
            alert(data.message);
        }
    });
}
function showGuestModal(){document.getElementById("guestModal").style.display="block";}
function closeGuestModal(){document.getElementById("guestModal").style.display="none";}
function submitGuestName(){
    const name=document.getElementById("guestNameInput").value.trim();
    if(!name){ alert("Enter name"); return;}
    player=name+" (Guest)";
    showWelcomeScreen();
}
function startPreQuiz(){
    document.getElementById("playerNameDisplay").textContent=player;
    document.getElementById("loginScreen").style.display="none";
    document.getElementById("signupScreen").style.display="none";
    document.getElementById("guestModal").style.display="none";
    document.getElementById("difficultyScreen").style.display="block";
    document.getElementById("quitBtn").style.display="block";
}

/* QUIT GAME */
function quitGame(){ 
    if(confirm("Are you sure you want to quit?")) location.reload();
 }

function showScreen(screenId){

    const screens = [
        "loginScreen",
        "signupScreen",
        "welcomeScreen",
        "difficultyScreen",
        "quizScreen",
        "resultScreen"
    ];

    screens.forEach(id=>{
        const el = document.getElementById(id);
        if(el) el.style.display = "none";
    });

    document.getElementById(screenId).style.display = "block";
}

/* START QUIZ */
function startQuizWithDifficulty(level){
       difficulty = level;
    showScreen("quizScreen");
    // Set player name in dashboard
    document.getElementById("playerNameDisplay").textContent = player;
    resetGame();
    generateQuestion();
    startTimer();

}

/* GENERATE QUESTION */
function generateQuestion(){
    let n1,n2,ops;
    if(difficulty==="easy"){n1=Math.floor(Math.random()*20)+1;n2=Math.floor(Math.random()*20)+1;ops=["+","-"];}
    else if(difficulty==="medium"){n1=Math.floor(Math.random()*50)+1;n2=Math.floor(Math.random()*50)+1;ops=["+","-","*"];}
    else{n1=Math.floor(Math.random()*100)+1;n2=Math.floor(Math.random()*100)+1;ops=["+","-","*","/"];}
    const op=ops[Math.floor(Math.random()*ops.length)];
    switch(op){ case "+": currentAnswer=n1+n2; break;
                 case "-": currentAnswer=n1-n2; break;
                 case "*": currentAnswer=n1*n2; break;
                 case "/": currentAnswer=parseFloat((n1/n2).toFixed(2)); break;}
    const questionText=`${n1} ${op} ${n2} = ?`;
    questionHistory.push({question:questionText, answer:currentAnswer});
    document.getElementById("question").textContent=questionText;
    generateOptions(currentAnswer);
}

/* GENERATE OPTIONS */
function generateOptions(correct){
    const options=new Set(); options.add(correct);
    while(options.size<4){
        let fake=Number.isInteger(correct)?correct+Math.floor(Math.random()*10-5):parseFloat((correct+(Math.random()*4-2)).toFixed(2));
        options.add(fake);
    }
    const shuffled=Array.from(options).sort(()=>Math.random()-0.5);
    const container=document.getElementById("optionsContainer");
    container.innerHTML="";
    shuffled.forEach(opt=>{
        const btn=document.createElement("button");
        btn.textContent=opt;
        btn.onclick=()=>handleAnswer(opt);
        container.appendChild(btn);
    });
}

/* HANDLE ANSWER */
function handleAnswer(selected){
    if(!timer) return;
    clearInterval(timer);
    timer = null;
    const buttons = document.querySelectorAll("#optionsContainer button");
    buttons.forEach(btn => btn.disabled = true);
    userAnswers.push(selected);

    if(selected === currentAnswer){
        correctCount++;
        score += 1;
        showAnswerOverlay(true);
    } else {
        wrongCount++;               // <-- add this
        showAnswerOverlay(false);
    }
}

// Inside timer's timeout:
if(timeLeft<=0){
    clearInterval(timer);
    timer = null;
    // Disable buttons
    document.querySelectorAll("#optionsContainer button").forEach(btn => btn.disabled = true);
    wrongCount++;                   // <-- add this
    showAnswerOverlay(false);
    }


/* FEEDBACK */
function showFeedback(msg,correct){
    const fb=document.getElementById("feedback");
    fb.textContent=msg;
    fb.className=correct?"feedback correct":"feedback wrong";
}

/* NEXT QUESTION */
function nextQuestion(){
     clearInterval(timer);
    currentQuestionIndex++;
    updateDashboard();
    if(currentQuestionIndex>=totalQuestions){ endQuiz(); return;}
    setTimeout(()=>{document.getElementById("feedback").textContent=""; generateQuestion(); startTimer();},500);
}

/* DASHBOARD UPDATE */
function updateDashboard(){
    document.getElementById("scoreDisplay").textContent = score;
    document.getElementById("progressDisplay").textContent = currentQuestionIndex + "/" + totalQuestions;
    document.getElementById("progressBar").style.width = (currentQuestionIndex/totalQuestions*100) + "%";
}

/* TIMER */
function startTimer(){
    timeLeft=10; 
    document.getElementById("timeDisplay").textContent = timeLeft + "s";
    timer=setInterval(()=>{
        timeLeft--;
        document.getElementById("timeDisplay").textContent = timeLeft + "s";
        if(timeLeft<=0){
         clearInterval(timer);
         timer = null;
         showAnswerOverlay(false);
        }
    },1000);
}

/* END QUIZ */
function endQuiz() {
    document.getElementById("quizScreen").style.display = "none";
    document.getElementById("summary").style.display = "block";

    wrongCount = totalQuestions - correctCount;
    const totalAnswered = correctCount + wrongCount;
    const accuracy = totalAnswered > 0 ? ((correctCount / totalQuestions) * 100).toFixed(2) : 0;

    // Dashboard values
    document.getElementById("finalPlayer").textContent = player;
    document.getElementById("finalScore").textContent = score;
    document.getElementById("finalPoints").textContent = score *  10;
    document.getElementById("finalCorrect").textContent = correctCount;
    document.getElementById("finalWrong").textContent = wrongCount;
    document.getElementById("finalAccuracy").textContent = accuracy + '%';

    // Save to database (only for registered users, not guests)
    if (!player.includes("(Guest)")) {
        fetch('update_score.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `score=${score}&correct=${correctCount}&wrong=${wrongCount}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Score saved successfully");
            } else {
                console.error("Failed to save score:", data.message);
            }
        })
        .catch(error => {
            console.error("Error saving score:", error);
        });
    }
}
/* RETRY QUIZ */
function retryQuiz(){
    document.getElementById("summary").style.display="none";
    document.getElementById("quizScreen").style.display="block";
    resetGame();
    generateQuestion();
    startTimer();
}

/* RESET GAME */
function resetGame(){
    if (timer) {
        clearInterval(timer);
        timer = null;
    }

    currentQuestionIndex=0;
     correctCount=0; 
     wrongCount=0; 
     score=0;
    userAnswers=[];
     questionHistory=[];
    updateDashboard();
    document.getElementById("feedback").textContent="";
}

function backToDifficulty(){
    clearInterval(timer); // stop timer if running

    document.getElementById("summary").style.display="none";
    document.getElementById("difficultyScreen").style.display="block";

    resetGame();
}

function showAnswerOverlay(isCorrect){
    const quizScreen = document.getElementById("quizScreen");

    const overlay = document.createElement("div");
    overlay.className = "answer-overlay";

    const box = document.createElement("div");
    box.className = "answer-box";

    let icon = isCorrect ? "✔" : "✖";
    let title = isCorrect ? "Correct!" : "Incorrect";
    let text = isCorrect ? "" : `The correct answer was ${currentAnswer}`;

    box.innerHTML = `
        <div class="answer-icon">${icon}</div>
        <div class="answer-title">${title}</div>
        <div class="answer-text">${text}</div>
    `;

    overlay.appendChild(box);
    quizScreen.appendChild(overlay);

    setTimeout(()=>{
        overlay.remove();
        nextQuestion();
    },1500);
}

function showWelcomeScreen(){
    showScreen("welcomeScreen");
    document.getElementById("welcomeUser").textContent = player;
     loadRecentGames();
}

function loadRecentGames() {
    const listDiv = document.getElementById('recentGamesList');
    const section = document.getElementById('recentGamesSection');

    // Hide section for guests
    if (player.includes('(Guest)')) {
        section.style.display = 'none';
        return;
    }

    section.style.display = 'block';
    listDiv.innerHTML = '<p style="color: var(--text-muted); text-align:center;">Loading...</p>';

    fetch('get_recent_games.php')
        .then(res => res.json())
        .then(data => {
            if (data.success && data.games.length > 0) {
                let html = '';
                data.games.forEach(game => {
                    html += `
                        <div style="background: #1E293B; margin: 10px 0; padding: 12px; border-radius: 10px; border-left: 4px solid var(--accent);">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="font-weight: bold;">Score: ${game.score}</span>
                                <span style="color: var(--accent);">Accuracy: ${game.accuracy}</span>
                            </div>
                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 5px;">${game.date}</div>
                        </div>
                    `;
                });
                listDiv.innerHTML = html;
            } else {
                listDiv.innerHTML = '<p style="color: var(--text-muted); text-align:center;">No games played yet.</p>';
            }
        })
        .catch(err => {
            console.error(err);
            listDiv.innerHTML = '<p style="color: #F87171; text-align:center;">Failed to load recent games.</p>';
        });
}

function goToDifficulty(){
    showScreen("difficultyScreen");
}

/* LOGOUT FUNCTION */
function logout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.reload();
    }
}

/* NEW HOME BUTTON FUNCTION: returns to welcome screen */
function goToWelcome() {
    document.getElementById("summary").style.display = "none";
    document.getElementById("quitBtn").style.display = "none"; // hide quit button if visible
    showWelcomeScreen(); // shows welcome and updates recent games
}

/* CLOSE MODAL ON OUTSIDE CLICK */
window.onclick=function(event){
    const modal=document.getElementById("guestModal");
    if(event.target==modal) closeGuestModal();
}

/* ========== PASSWORD STRENGTH METER & REQUIREMENTS ========== */
function updatePasswordStrength(password, username) {
    const meter = document.getElementById('passwordStrength');
    if (!meter) return;

    // If password is empty, show default
    if (!password) {
        meter.textContent = 'Enter password';
        meter.className = 'strength-meter strength-0';
        return;
    }

    const level = evaluatePasswordStrength(password, username);
    const labels = ['Too Weak', 'Weak', 'Medium', 'Strong', 'Very Strong'];
    meter.textContent = labels[level];
    meter.className = `strength-meter strength-${level}`;
}

function evaluatePasswordStrength(password, username) {
    // Common weak passwords list
    const commonPasswords = [
        '123456', 'password', '123456789', '12345', '12345678',
        'qwerty', 'abc123', 'password123', 'admin', 'letmein',
        'welcome', 'monkey', '1234567', '123123', '111111'
    ];

    const pwd = password;
    const user = username.toLowerCase();

    // Check for very weak conditions first
    if (pwd.length < 6) return 0;
    if (commonPasswords.includes(pwd.toLowerCase())) return 0;
    if (user.length >= 3 && pwd.toLowerCase().includes(user)) return 0;
    if (/^[a-z]+$/.test(pwd) || /^[0-9]+$/.test(pwd)) return 0; // only lowercase letters or only digits

    // Count character types
    const hasLower = /[a-z]/.test(pwd);
    const hasUpper = /[A-Z]/.test(pwd);
    const hasDigit = /[0-9]/.test(pwd);
    const hasSymbol = /[^a-zA-Z0-9]/.test(pwd);

    let variety = 0;
    if (hasLower) variety++;
    if (hasUpper) variety++;
    if (hasDigit) variety++;
    if (hasSymbol) variety++;

    // Length check
    if (pwd.length >= 12 && variety >= 4) return 4; // Very Strong
    if (pwd.length >= 10 && variety >= 3) return 3; // Strong
    if (pwd.length >= 8 && variety >= 2) return 2; // Medium
    if (pwd.length >= 8) return 1; // Weak (but length >=8 with low variety)
    if (pwd.length >= 6) return 1; // Weak (length 6-7)
    return 0;
}

function updateRequirements(password, repassword) {
    const hasLower = /[a-z]/.test(password);
    const hasUpper = /[A-Z]/.test(password);
    const hasDigit = /[0-9]/.test(password);
    const hasSymbol = /[^a-zA-Z0-9]/.test(password);
    const match = password === repassword && password.length > 0;

    const reqLength = document.getElementById('reqLength');
    const reqLower = document.getElementById('reqLower');
    const reqUpper = document.getElementById('reqUpper');
    const reqDigit = document.getElementById('reqDigit');
    const reqSymbol = document.getElementById('reqSymbol');
    const reqMatch = document.getElementById('reqMatch');

    // Length requirement (we'll use 8 as minimum)
    if (password.length >= 8) {
        reqLength.className = 'valid';
        reqLength.innerHTML = '✅ At least 8 characters';
    } else {
        reqLength.className = 'invalid';
        reqLength.innerHTML = '❌ At least 8 characters';
    }

    // Lowercase
    if (hasLower) {
        reqLower.className = 'valid';
        reqLower.innerHTML = '✅ Lowercase letter';
    } else {
        reqLower.className = 'invalid';
        reqLower.innerHTML = '❌ Lowercase letter';
    }

    // Uppercase
    if (hasUpper) {
        reqUpper.className = 'valid';
        reqUpper.innerHTML = '✅ Uppercase letter';
    } else {
        reqUpper.className = 'invalid';
        reqUpper.innerHTML = '❌ Uppercase letter';
    }

    // Digit
    if (hasDigit) {
        reqDigit.className = 'valid';
        reqDigit.innerHTML = '✅ Number';
    } else {
        reqDigit.className = 'invalid';
        reqDigit.innerHTML = '❌ Number';
    }

    // Symbol
    if (hasSymbol) {
        reqSymbol.className = 'valid';
        reqSymbol.innerHTML = '✅ Special character (!@#$%^&*)';
    } else {
        reqSymbol.className = 'invalid';
        reqSymbol.innerHTML = '❌ Special character (!@#$%^&*)';
    }

    // Match
    if (match) {
        reqMatch.className = 'valid';
        reqMatch.innerHTML = '✅ Passwords match';
    } else {
        reqMatch.className = 'invalid';
        reqMatch.innerHTML = '❌ Passwords match';
    }
}

// Password toggles for login and signup
document.addEventListener('DOMContentLoaded', function() {
    // Signup fields
    const pwdInput = document.getElementById('signupPassword');
    const rePwdInput = document.getElementById('signupRePassword');
    const userInput = document.getElementById('signupUsername');
    const toggleSignupBtn = document.getElementById('toggleSignupPasswordBtn');

    // Login field
    const loginPwdInput = document.getElementById('loginPassword');
    const toggleLoginBtn = document.getElementById('toggleLoginPasswordBtn');

    function updateAll() {
        const password = pwdInput ? pwdInput.value : '';
        const repassword = rePwdInput ? rePwdInput.value : '';
        const username = userInput ? userInput.value.trim() : '';

        updatePasswordStrength(password, username);
        updateRequirements(password, repassword);
    }

    if (pwdInput) {
        pwdInput.addEventListener('input', updateAll);
    }
    if (rePwdInput) {
        rePwdInput.addEventListener('input', updateAll);
    }
    if (userInput) {
        userInput.addEventListener('input', updateAll);
    }

    // Toggle signup passwords visibility
    if (toggleSignupBtn) {
        toggleSignupBtn.addEventListener('click', function() {
            const type = pwdInput.type === 'password' ? 'text' : 'password';
            pwdInput.type = type;
            rePwdInput.type = type;
            // Change button text and icon
            if (type === 'text') {
                toggleSignupBtn.innerHTML = '🙈 Hide passwords';
            } else {
                toggleSignupBtn.innerHTML = '👁 Show passwords';
            }
        });
    }

    // Toggle login password visibility
    if (toggleLoginBtn && loginPwdInput) {
        toggleLoginBtn.addEventListener('click', function() {
            const type = loginPwdInput.type === 'password' ? 'text' : 'password';
            loginPwdInput.type = type;
            // Change button text and icon
            if (type === 'text') {
                toggleLoginBtn.innerHTML = '🙈 Hide password';
            } else {
                toggleLoginBtn.innerHTML = '👁 Show password';
            }
        });
    }
});
</script>
</body>
</html>