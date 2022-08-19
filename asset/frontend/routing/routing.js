var page_name, app_name;
var get_param1, get_param2;
var pageTitle = document.getElementById('pageTitle');

//normale seiten
crossroads.addRoute('{page}/:subPage:/:param1:/:param2:', function(page, subPage, param1, param2) {
  //toggleAccess(false);
  //console.log(page, subPage, param1, param2);

  get_param1 = param1;
  get_param2 = param2;

  //        if (app_name != page) {
  //            initAppbar(0);
  //        }

  app_name = page;

  if (!subPage) {
    page_name = page;

    getPage(page_name);
  } else {
    page_name = page + '/' + subPage;
    //console.log(get_param1);
    //console.log(page_name);
    //if ($('#DokuMeSubmenu').is(':empty'))
    //    loadConfig(page);
    getPage(page_name, get_param1);
  }

  //pageTitle.dataset.i18n = 'menu.' + page;
  //pageTitle.innerHTML = i18next.t('menu.' + page);
});

//keine route passt
crossroads.bypassed.add(function(request) {
  console.log(base_url)
  $('#main').load(base_url + 'app/home.html');
});
/*****************setup hasher*******************/
function parseHash(newHash, oldHash) {
  crossroads.parse(newHash);
  /*reset menus*/
  if (window.innerWidth < 770) {
    //navDIV.style.display = 'none';
    //asideDIV.style.display = 'none';
  } else if (window.innerWidth > 770 && window.innerWidth < 1000) {
    //asideDIV.style.display = 'none';
  }
  //overlayDIV.style.display = 'none';

  $('.DokuMe-Menu li').removeClass('active');
  $('.DokuMe-Menu [href="#/' + newHash + '"]').addClass('active');
}

hasher.initialized.add(parseHash);
//parse initial hash
hasher.changed.add(parseHash);
//parse hash changes
//hasher.init(); -> init hasher on dokume start
//start listening for history change

//update URL fragment generating new history record
//hasher.setHash('dashboard');

function getPage(url, surl) {
  var appUrl = typeof appUrl !== 'undefined' ? appUrl : 0;
  //surl = typeof surl !== 'undefined' ? appUrl : 0;
  //console.log(surl);
  $('#main').empty();
  $('#main').html("<div class='loading'></div>");
  console.log(appUrl)
  if (appUrl == 0) {
    url = 'app/page.html?' + url + (typeof surl !== 'undefined' ? '/' + surl : '');
  } else {
    url = 'app/page.html?' + appUrl + '/' + url + (typeof surl !== 'undefined' ? '/' + surl : '');
  }
  $('#main').load(url, function() {});
}

// load config.js file for an app where you can specifiy further functions on load of the app
function loadConfig(appUrl) { //console.log(appUrl);
  $.getScript('APPS/' + appUrl + '/config.js'); /*platform.php/*/
}

$(function() {
  hasher.init();
});
