function showArticleDetails(articleId) {
    fetch(`get_article.php?id=${articleId}`)
        .then(response => response.json())
        .then(data => {
            const articleDetails = `
                <h2>${data.title}</h2>
                <p><strong>Authors:</strong> ${data.authors}</p>
                <p>${data.description}</p>
                <a href="${data.pdf_link}" target="_blank">Read Full Article</a>
            `;
            document.getElementById('article-details').innerHTML = articleDetails;
            document.getElementById('article-popup').style.display = 'block';
        })
        .catch(error => console.error('Error fetching article details:', error));
}

function closePopup() {
    document.getElementById('article-popup').style.display = 'none';
}

function upvoteArticle(articleId) {
    fetch('vote.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `article_id=${articleId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Upvote recorded.');
            location.reload();  // Reload the page to update the likes count
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error upvoting article:', error));
}
