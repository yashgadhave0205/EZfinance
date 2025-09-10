//import Fuse from 'https://cdn.jsdelivr.net/npm/fuse.js@6.6.2/dist/fuse.esm.js';


// AI Data
const financialTopics = 
[
    { 
        topic: 'hey',
         advice: "Hey, I'm EZfinance's Personal AI Assistant. I'm here to advise about Finance. Feel free to ask!"
    },

    { 
        topic: 'hello',
         advice: "Hello, I'm EZfinance's Personal AI Assistant. I'm here to advise about Finance. Feel free to ask!" 
    },
    { 
        topic: 'hi',                  
        advice: "Hi there, I'm EZfinance's Personal AI Assistant. I'm here to advise about Finance. Feel free to ask!"
     },
     { 
        topic: 'hii',                  
        advice: "Hii there, I'm EZfinance's Personal AI Assistant. I'm here to advise about Finance. Feel free to ask!"
     },
     { 
        topic: 'hiii',                  
        advice: "Hiii there, I'm EZfinance's Personal AI Assistant. I'm here to advise about Finance. Feel free to ask!"
     },
     {
        topic: 'how are you',
        advice: "I'm doing great, thanks for asking! I'm EZfinance's Personal AI Assistant, I can assist you about your finance. Feel free to ask !"

     },
    { 
        topic: 'budget', 
        advice: "Creating a budget is crucial for financial success. Start by tracking your income and expenses, then allocate your money to different categories like necessities, savings, and discretionary spending. Aim to follow the 50/30/20 rule: 50% for needs, 30% for wants, and 20% for savings and debt repayment."
     },
    { 
        topic: 'invest', 
        advice: "Investing is key to building long-term wealth. Consider diversifying your portfolio across stocks, bonds, real estate, and other assets. Start with low-cost index funds if you're new to investing. Remember to assess your risk tolerance and investment horizon before making decisions." 
    },
    {
         topic: 'contact', 
         advice: "EZfinance is a platform that offers AI-based easy financing solutions for both businesses and customers. To contact us, you can visit our website EZfinance.com or mail us at ezfinance@gmail.com." 
        },
    { 
        topic: 'save', 
        advice: "Saving money is the foundation of financial security. Aim to save at least 20% of your income. Set up automatic transfers to your savings account each payday. Consider high-yield savings accounts for better interest rates on your emergency fund." 
    },
    { 
        topic: 'debt', 
        advice: "Managing debt is crucial for financial health. Focus on paying off high-interest debt first, such as credit card balances. Consider the debt avalanche (focusing on the highest interest rate) or debt snowball (focusing on the smallest balance) methods. Look into debt consolidation or refinancing options if appropriate." 
    },
    { 
        topic: 'retirement', 
        advice: "Planning for retirement should start early. Maximize contributions to tax-advantaged accounts like 401(k)s and IRAs. Consider a mix of traditional and Roth accounts for tax diversification. Adjust your investment strategy as you get closer to retirement age."
     },
    { 
        topic: 'emergency fund', 
        advice: "An emergency fund is your financial safety net. Aim to have 3-6 months of living expenses saved in an easily accessible account. This fund should cover unexpected costs or income loss without derailing your other financial goals." 
    },
    { 
        topic: 'credit score', 
        advice: "Your credit score impacts many aspects of your financial life. Maintain a good score by paying bills on time, keeping credit utilization low (under 30%), and regularly checking your credit report for errors. A good credit score can lead to better loan terms and interest rates." 
    },
    { 
        topic: 'taxes', 
        advice: "Understanding and planning for taxes can save you money. Keep thorough records of your income and expenses throughout the year. Look into tax-advantaged accounts and deductions you might be eligible for. Consider consulting with a tax professional for complex situations." 
    },
    { 
        topic: 'insurance',
         advice: "Proper insurance protects your finances from catastrophic events. Ensure you have adequate health, life, disability, and property insurance. Regularly review your policies to make sure they still meet your needs as your life circumstances change."
         },
    { 
        topic: 'financial goals',
        advice: "Setting clear financial goals helps guide your decisions. Use the SMART criteria: Specific, Measurable, Achievable, Relevant, and Time-bound. Common goals include buying a home, saving for education, or achieving financial independence." 
    },
    { 
        topic: 'passive income',
         advice: "Developing passive income streams can enhance your financial stability. Consider options like dividend-paying stocks, rental properties, creating digital products, or starting a side business that can generate income with minimal ongoing effort." 
        },
    { 
        topic: 'estate planning', 
        advice: "Estate planning ensures your assets are distributed according to your wishes. Create a will, consider setting up trusts, and designate beneficiaries for your accounts. This planning can also help minimize estate taxes and avoid probate." 
    },
    {
        topic: 'financial literacy', 
        advice: "Improving your financial literacy is an ongoing process. Stay informed about personal finance topics through books, reputable websites, and courses. Understanding financial concepts will help you make better decisions with your money." 
    },
    { 
        topic: 'crypto currency',
        advice: "Cryptocurrency is a volatile but potentially high-reward investment. If you're interested, start by learning about blockchain technology and the risks involved. Only invest what you can afford to lose, and consider it as part of a diversified portfolio." 
    
    },
    {
         topic: 'real estate',
          advice: "Real estate can be a valuable part of your investment strategy. Options include buying a home, investing in rental properties, or participating in real estate investment trusts (REITs). Consider factors like location, market trends, and ongoing costs." 
    },
    { 
        topic: 'side hustle',
         advice: "A side hustle can boost your income and provide financial flexibility. Look for opportunities that align with your skills and interests. This could include freelancing, selling handmade items, or offering services in your community." 
    },
    { 
        topic: 'inflation', 
        advice: "Understanding inflation is crucial for long-term financial planning. Ensure your investments and savings strategies account for the eroding effect of inflation on purchasing power. Aim for returns that outpace inflation to grow your wealth in real terms." 
    },
    { 
        topic: 'risk management', 
        advice: "Risk management involves protecting your investments and wealth from market volatility, economic downturns, or unforeseen events. Diversify your portfolio and consider insurance and emergency funds as part of a solid risk management strategy." 
    },
    { 
        topic: 'tax planning', 
        advice: "Effective tax planning can help you keep more of your earnings. Use tax-advantaged accounts like 401(k)s, IRAs, and HSAs, and explore deductions and credits that apply to your situation. Consult a tax professional for personalized advice.You Can Calculate your Income tax by on EZfinance by going on Open Sidebar >> Financial Calculations >> Calculate Tax." 
    },
    { 
        topic: 'cash flow management', 
        advice: "Cash flow management is critical for both individuals and businesses. Keep track of your inflows and outflows to ensure you have enough liquidity to cover expenses, save for goals, and invest for the future."
     },
    { 
        topic: 'investment strategy',
        advice: "Building an investment strategy involves balancing risk and reward. You might focus on growth stocks, dividend-paying investments, or bonds depending on your goals and risk tolerance. Revisit your strategy regularly as markets shift."

    },
    {
        topic: 'retirement income',
        advice: "Planning for income in retirement is essential. Consider the role of Social Security, pensions, and withdrawals from retirement accounts. Create a strategy to ensure you don't outlive your savings by estimating future expenses and adjusting your investments accordingly"

    },
    {
        topic: 'sustainable investing',
        advice: "Sustainable investing focuses on companies with positive environmental, social, and governance (ESG) practices. It's an approach that seeks financial returns while considering broader social impacts"
    },
    {
        topic: 'student loan',
        advice: "Managing student loans requires careful planning. Understand your repayment options, including income-driven plans. Consider refinancing for better rates if your credit has improved since taking out the loans. Prioritize paying off high-interest loans first."
    },
    {
        topic: 'credit score',
        advice: "Maintaining a good credit score is crucial for financial health. Pay bills on time"
    },
    {
        topic: 'interest rates',
        advice: "Understanding how interest rates affect loans and savings is crucial. Higher interest rates increase borrowing costs but can also lead to better returns on savings accounts."
    },
    {
        topic: 'market votality',
        advice: "Financial markets can be unpredictable. Diversifying investments and maintaining a long-term perspective can help manage the risks associated with market fluctuations."
    },
    {
        topic: 'financial stress',
        advice: "Money-related stress is common. Building an emergency fund, creating a realistic budget, and seeking professional advice can alleviate financial anxiety."
    },
    {
        topic: 'learn finance',
        advice: "To learn finance, start with the basics like budgeting, saving, and investing. Read books like The Intelligent Investor and follow websites like Investopedia. Take online courses and stay updated with financial news. Most importantly, apply your knowledge through real-world practice."
    },


    {
        topic: 'business ideas',
        advice: "Here are a few business ideas to get you started : 1) E-commerce Niche Store: Sell specialized products online (e.g., eco-friendly items, pet accessories). 2) Subscription Box Service: Curate and deliver subscription boxes (e.g., beauty products, snacks) 3) Digital Marketing Agency: Offer SEO, social media management, and content creation. 4) Online Coaching: Share your expertise by offering online courses or coaching sessions. 5) Health & Wellness Products: Sell supplements, organic foods, or fitness gear. 6) Mobile App Development: Build apps to solve specific problems or enhance daily life. 6) Freelance Services: Offer writing, graphic design, or web development on freelancing platforms. 7) Home Improvement Services: Provide home repair or renovation services. 8) Sustainable Fashion Line: Launch a fashion brand using eco-friendly materials. 9) AI & Automation Solutions: Help businesses streamline processes with AI tools.                                      If you want to know more about these business ideas in detail, you can visit these websites: Entrepreneur.com, Forbes Business Ideas, Shopify Blog"
    },    
    {
        topic: 'team',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'developer of',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'developer',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'developers',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'developed by',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'developer of EZfinance',
        advice: "EZfinance is developed to provide AI-driven financial advises , developed by Yash Gadhave (Team leadaer), Vivek Date, Avinash Dabhade & Siddhesh Gadhave"
    },
    {
        topic: 'simple interest',
        advice: "Simple Interest (SI) is the interest calculated on the initial principal amount for a specific period at a fixed rate of interest. It does not take into account any interest that accumulates on the previously earned interest (no compounding). You can calculate Simple Interest on EZfinance for free by going on Open Sidebar >> Financial Calculations >> Calculate Simple Interest."
    },
    {
        topic: 'emi',
        advice: "EMI stands for Equated Monthly Installment. It is the fixed amount of money you pay every month to repay a loan — like a home loan, car loan, personal loan, etc.You can Calculate you EMI on EZfinance for free by going on Some More Features >> Financial Calculations >> Calculaye EMI."
    },
    {
        topic: 'sip',
        advice: "SIP stands for Systematic Investment Plan. It’s a method of investing a fixed amount of money at regular intervals (usually monthly) in a mutual fund. Instead of investing a large amount at once, you invest smaller amounts consistently over time. You Can Calcuate the SIP for free on EZfinance by going on Open Sidebar >> Financial Calculations >> SIP Calculator."

    },
    {
        topic: 'expense',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'track',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'tracking',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'expense tracking',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'expense tracker',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'tracker',
        advice: "Expense tracking means recording, monitoring, and managing all the money you spend — whether it's on food, shopping, travel, bills, or entertainment. You can track your all expenses for free on EZfinance by going on Open Sidebar >> Expense Tracker."
    },
    {
        topic: 'news',
        advice: "You can see Latest Financial News Daily for free on EZfinance by going on Open Sidebar >> Latest Financial News"
    },
    {
        topic: 'convert',
        advice: "You can convert any currency into another currency like USD to INR or any other on EZfinance for free by going on Open Sidebar >> Currency Converter."
    },
    {
        topic: 'converter',
        advice: "You can convert any currency into another currency like USD to INR or any other on EZfinance for free by going on Open Sidebar >> Currency Converter."
    },
    {
        topic: 'currency converter',
        advice: "You can convert any currency into another currency like USD to INR or any other on EZfinance for free by going on Open Sidebar >> Currency Converter."
    },
    {
        topic: 'ezfinance',
        advice: "EZfinance is an innovative platform which is developed to manage your finances. It gives personalized AI powered financial advices to users. It also contains more features like Personalized Expense Tracker, Provides Latest Financial News, PerFinancial Calculations"
    },
    {
        topic: 'what is ezfinance',
        advice: "EZfinance is an innovative platform which is developed to manage your finances. It gives personalized AI powered financial advices to users. It also contains more features like Personalized Expense Tracker, Provides Latest Financial News, PerFinancial Calculations"
    }






];

document.addEventListener('DOMContentLoaded', () => {
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');

    // Initialize Fuse.js
    const fuse = new Fuse(financialTopics, {
        keys: ['topic'],
        threshold: 0.4, // Adjust this value based on your desired sensitivity
    });

    // Add initial greeting
    addMessage("Hello! I'm your EZfinance AI assistant. How can I help you with your financial questions today?", 'ai');

    chatbotForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const message = chatbotInput.value.trim();
        if (message) {
            addMessage(message, 'user');
            chatbotInput.value = '';
            generateResponse(message);
        }
    });

    function addMessage(message, sender) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender + '-message');
        messageElement.textContent = message;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function generateResponse(message) {
        const lowerMessage = message.toLowerCase();
        let response = "I'm sorry, I don't have specific advice on that topic. Could you try asking about budgeting, investing, saving, debt, or other financial topics?";
    
        const result = fuse.search(lowerMessage);
        if (result.length > 0) {
            response = result[0].item.advice;
        }
    
        setTimeout(() => {
            addMessage(response, 'ai');
        }, 2000); // Simulating a brief delay for the AI response
    }
    
})

















//sidebar
function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
}

function toggleDropdown(id) {
    var dropdown = document.getElementById(id);
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}












// Mic - Voice Recognition
function startVoiceRecognition() {
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.start();

    recognition.onresult = function(event) {
        document.getElementById("chatbot-input").value = event.results[0][0].transcript;
    };

    recognition.onerror = function(event) {
        console.error("Voice recognition error:", event.error);
    };
}



