import axios from 'axios';
import $ from 'jquery';

$(document).ready(function () {
    $('.like-btn').on('click', function () {
        var postId = $(this).closest('.like-form').data('post-id');
        sendReaction(postId, 'like', $(this));
    });

    $('.dislike-btn').on('click', function () {
        var postId = $(this).closest('.dislike-form').data('post-id');
        sendReaction(postId, 'dislike', $(this));
    });

    function sendReaction(postId, reaction, button) {
        axios.post(`/posts/${postId}/${reaction}`, {
                _token: $('meta[name="csrf-token"]').attr('content'),
            })
            .then(function (response) {
                // Aktualizuj widok posta po udanej reakcji
                // Możesz również dodać animacje lub inne efekty
                // Na razie używamy animacji CSS do wibracji i zmiany koloru
                button.addClass('animated-btn');
                setTimeout(function () {
                    button.removeClass('animated-btn');
                }, 1000);
            })
            .catch(function (error) {
                console.error('Error sending reaction:', error);
            });
    }
});
