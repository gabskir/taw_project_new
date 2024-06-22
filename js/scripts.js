document.addEventListener('DOMContentLoaded', function() {
    const upvoteButtons = document.querySelectorAll('.upvote-btn');
    
    upvoteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const articleId = this.getAttribute('data-article-id');
            
            fetch('upvote.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ article_id: articleId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const likesElement = document.getElementById(`likes-${articleId}`);
                    likesElement.textContent = parseInt(likesElement.textContent) + 1;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
