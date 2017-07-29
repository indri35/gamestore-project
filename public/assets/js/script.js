$(document).ready(function() {
  /* Resize iframe to fit the canvas */
  var iframe = $('.gs-play-iframe'),
      cardPlay = $('.card-play'),
      cardPlayHeight = cardPlay.height() + 'px';

  if($(window).width() < 767) {
    iframe.css('height', cardPlayHeight);
  }

  $(window).resize(function() {
    var cardPlay = $('.card-play'),
        cardPlayHeight = cardPlay.height() + 'px';

    iframe.css('height', cardPlayHeight);
  });

  /* Hide card-play while click close button */
  var minimizeBtn = $('.card-play-close');

  minimizeBtn.on('click', function() {
    cardPlay.remove();
  });
});