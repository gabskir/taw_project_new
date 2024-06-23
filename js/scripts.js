document.addEventListener('DOMContentLoaded', function() {
    const upvoteButtons = document.querySelectorAll('.upvote-btn');
    
    upvoteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default button action
            
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
                console.log('Response from server:', data); // Debugging: Log server response
                alert(data.message); // Show the message from the server
                if (data.status === 'success') {
                    const likesElement = document.getElementById(`likes-${articleId}`);
                    likesElement.textContent = parseInt(likesElement.textContent) + 1;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
