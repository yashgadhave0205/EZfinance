// API key for NewsAPI (replace with your own)
const apiKey = '9c706e15464e4f9fbb619b1b4c98cefa'; //News API Key
const url = `https://newsapi.org/v2/top-headlines?category=business&apiKey=${apiKey}`; //News API Link

// Function to fetch and display the news headlines
async function fetchNews() {
    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.status === 'ok') {
            const articles = data.articles.slice(0, 10); // Get the first 10 articles
            const newsContainer = document.getElementById('news-container');

            // Clear previous news
            newsContainer.innerHTML = '';

            // Display the headlines
            articles.forEach(article => {
                const newsItem = document.createElement('div');
                newsItem.classList.add('news-item');

                // Create the headline and "Learn More" link
                newsItem.innerHTML = `
                    <a href="${article.url}" target="_blank">${article.title}</a>
                    <a class="learn-more" href="${article.url}" target="_blank">Learn More</a>
                `;
                newsContainer.appendChild(newsItem);
            });
        } else {
            console.error('Error fetching news:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Call the function to fetch and display news
fetchNews();
