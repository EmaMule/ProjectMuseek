function LikeUpdate(id, autore, utente) {
  //incdec è il modo di far comunicare js con il php
  //il .php solo tramite echo può ritornare incdec e quindi in result avremo questo valore
  //usiamo result per aumentare o diminuire visivamente il numero di like al click, mentre nel db
  $.ajax({
    url: "../php-function/update_likes.php",
    type: "post",
    data: "type=like&id=" + id + "&autore=" + autore + "&utente=" + utente,
  }).done(function (result) {
    result = JSON.parse(result);
    var incdec = parseInt(result);
    var cur_count = jQuery("#likecount").html();
    cur_count = parseInt(cur_count);
    cur_count += incdec;
    jQuery("#likecount").html(cur_count);
  });
}

function FollowUpdate(utente, autore) {
  var value_button = jQuery("#btn-follow").html();
  $.ajax({
    url: "../php-function/update_follow.php",
    type: "post",
    data: "type=" + value_button + "&utente=" + utente + "&autore=" + autore,
  }).done(function (result) {
    value_button = jQuery("#btn-follow").html(result);

    follower_count = jQuery("#follower_count");
    if (follower_count) {
      cnt = follower_count.html();
      cnt = parseInt(cnt);
      if (result == "Following") {
        cnt += 1;
      } else {
        cnt -= 1;
      }
      follower_count.html(cnt);
    }
  });
}
