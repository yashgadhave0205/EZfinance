from flask import Flask, request, jsonify, render_template
from flask_cors import CORS
import google.generativeai as genai

app = Flask(__name__)
CORS(app)

# ✅ Set your Gemini API Key here
genai.configure(api_key="AIzaSyAdxfce6b6Pzoab64sBFBWtF2nnLyo6jPc")

# ✅ Load the Gemini model
model = genai.GenerativeModel("gemini-1.5-flash")

# ✅ Serve HTML page
@app.route("/")
def home():
    return render_template("testchat.html")

# ✅ Predefined local Q&A
ezfinance_qa = {
    "what is sip": "SIP (Systematic Investment Plan) lets you invest a fixed amount in mutual funds regularly.",
    "how to use sip calculator": "To use the SIP calculator, enter your monthly investment, duration, and expected return rate.",
    "what is expense tracker": "Our Expense Tracker helps you track and categorize daily expenses easily.",
    "how to convert currency": "Use our Currency Converter to switch between INR, USD, EUR, etc.",
    "what is ezfinance": "EZfinance is your personal financial advisor with tools like AI assistant, SIP calculator, expense tracker and more!"
}

# ✅ Local match
def search_local_answer(prompt):
    prompt = prompt.lower()
    for q in ezfinance_qa:
        if q in prompt:
            return ezfinance_qa[q]
    return None

# ✅ Gemini API
def ask_gemini(prompt):
    try:
        response = model.generate_content(prompt)
        return response.text.strip()
    except Exception as e:
        return f"[Gemini API Error]: {str(e)}"

# ✅ API route
@app.route("/chat", methods=["POST"])
def chat():
    user_query = request.json.get("message", "").strip()
    if not user_query:
        return jsonify({"source": "none", "response": "No input received."})

    # Check locally
    local = search_local_answer(user_query)
    if local:
        return jsonify({"source": "ezfinance", "response": local})

    # Else use Gemini
    gemini_response = ask_gemini(user_query)
    return jsonify({"source": "gemini", "response": gemini_response})

if __name__ == "__main__":
    app.run(port=5000)
