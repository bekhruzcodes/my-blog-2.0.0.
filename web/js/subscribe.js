document.addEventListener('DOMContentLoaded', function() {
    // Subscribe form handler
    const subscribeForm = document.getElementById("mc-form-unique");
    if (subscribeForm) {
        subscribeForm.addEventListener("submit", async function(event) {
            event.preventDefault();

            const email = document.getElementById("mc-email-unique").value;
            const messageElement = document.querySelector(".subscribe-message-unique");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            const submitUrl = subscribeForm.getAttribute('data-submit-url');

            const formData = new FormData();
            formData.append("cName", "Subscriber");
            formData.append("cWebsite", email);
            formData.append("cMessage", "I wanna hear more from you");
            formData.append("post_id", "0");

            try {
                const response = await fetch(submitUrl, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                });

                const result = await response.json();
                if (messageElement) {
                    messageElement.innerText = result.message;
                }

                if (result.success) {
                    this.reset();
                }
            } catch (error) {
                console.error("Error submitting subscription:", error);
                if (messageElement) {
                    messageElement.innerText = "An error occurred while submitting the form.";
                }
            }
        });
    }
});






document.getElementById('submitComment').addEventListener('click', function () {
    const formData = {
        post_id: document.getElementById('post_id').value,
        cName: document.getElementById('cName').value,
        cWebsite: document.getElementById('cWebsite').value,
        cMessage: document.getElementById('cMessage').value,
    };

    const url = document.getElementById('commentForm').dataset.url; // Get the URL from the form attribute
    const csrfToken = document.getElementById('commentForm').dataset.csrf; // Get the CSRF token from the form attribute

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-Token': csrfToken,
        },
        body: new URLSearchParams(formData).toString(),
    })
        .then(response => response.json())
        .then(data => {
            const feedbackDiv = document.getElementById('commentFeedback');
            if (data.success) {
                feedbackDiv.innerHTML = '<div class="alert-box alert-box--success">' + data.message + '</div>';
                document.getElementById('commentForm').reset();
            } else {
                feedbackDiv.innerHTML = '<div class="alert-box alert-box--error">' + data.message + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('commentFeedback').innerHTML =
                '<div class="alert alert-danger">An unexpected error occurred.</div>';
        });
});
