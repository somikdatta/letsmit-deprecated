//navbar slider
$(document).ready(function () {
  var toggleMenu = function () {
    $('header').toggleClass('toggle');
  };

  //Nav
  $('.navBtn').click(function () {
    toggleMenu();
  });
});
//greetings
var thehours = new Date().getHours();
var day = new Date().getDay();
var daynamearr = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
if (thehours > 18) {
  ++day;
  if (day==7)
  day=0;
}
var dayname = daynamearr[day];
var themessage;
var attr;
var mornsun = (' Good morning, sunshine!');
var morning = (' Good morning!');
var afternoon = (' Good afternoon!');
var evening = (' Good evening!');
var tobed = (' Go to bed!');
if (thehours >= 3 && thehours < 7) {
  themessage = mornsun;
  attr = '<i class="yellow fas fa-cloud-sun"></i>';
} else if (thehours >= 7 && thehours < 12) {
  themessage = morning;
  attr = '<i class="yellow fas fa-sun"></i>';

} else if (thehours >= 12 && thehours < 17) {
  themessage = afternoon;
  attr = '<i class="yellow fas fa-sun"></i>';

} else if (thehours >= 17 && thehours < 23) {
  themessage = evening;
  attr = '<i class="grey far fa-moon"></i>';
} else if (thehours >= 23 || thehours < 3) {
  themessage = tobed;
  attr = '<i class="grey fas fa-moon"></i>';
}
localStorage.setItem('day', day);

function greet() {
  $('.gmsg').empty();
  $('.gmsg').html(attr);
  $('.gmsg').append(themessage);
};
$(document).ready(greet);

//switch grid to list view
function getDay() {
  var container = $('.main');
  var newday = new Date().getDay();
  container.load("frames/landing.php?day=" + dayname);
  return false;
}

function removeDay() {
  localStorage.setItem('day', day);
  var container = $('.main');
  container.load("frames/landing.php");
  return false;
}
//scroll through routine
var scrollday;

function getNextDay(target, scrollday = -1) {
  if (scrollday == -1) {
    scrollday = localStorage.getItem('day');
  }
  if (scrollday >= 6) {
    scrollday = -1;
  }
  console.log(scrollday);
  var container = $('.main');
  container.load(target + daynamearr[++scrollday]);
  localStorage.setItem('day', scrollday);
  return false;
}

function getPrevDay(target) {
  var scrollday = localStorage.getItem('day');
  if (scrollday <= 0) {
    scrollday = 7;
  }
  console.log(scrollday);
  var container = $('.main');
  container.load(target + daynamearr[--scrollday]);
  localStorage.setItem('day', scrollday);
  return false;
}
//ajax .main load
$(document).ready(function () {
  var trigger = $('.navigation .link'),
    container = $('.main');
  trigger.on('click', function (e) {
    e.preventDefault();
    var $this = $(this),
      target = $this.data('target');
    if (target == 'frames/mess.php') {
      if (thehours > 21) {
        container.load("frames/mess.php?day=" + dayname);
      } else if (thehours > 18) {
        container.load("frames/mess.php?day=" + daynamearr[day - 1]);
      } else {
        container.load("frames/mess.php?day=" + dayname);
      }
    } else {
      container.load(target + '#mainload');
    }
    return false;
  });
});
//inject greeting after ajax is done
$(document).ajaxComplete(function () {
  greet();
});
$("#droptext").click(function () {
  getDay();
});