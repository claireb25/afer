$(document).ready( function() {
  
    $('body').on("click", ".larg div h3", function(){
      if ($(this).children('span').hasClass('close')) {
        $(this).children('span').removeClass('close');
      }
      else {
        $(this).children('span').addClass('close');
      }
      $(this).parent().children('p').slideToggle(250);
    });

    $('body').on("click", ".small-entities", function(e){
      if ($(this).children('span').hasClass('close')) {
        $(this).children('span').removeClass('close');
      }
      else {
        $(this).children('span').addClass('close');
      }
      $(this).parent().children('.list-small-entities').slideToggle(250);
    });

   
    
    $('body').on("click", "nav ul li a", function(e){
      // e.preventDefault();
      var title = $(this).data('title');
      $('.title').children('h2').html(title);
    });
    
  });