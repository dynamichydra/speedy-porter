(function () {
    init();

    function init() {
      DM_CMS.get205Object(null,{type:'banner',position:'home'},insertBanner);;
    }

    function insertBanner(data){
      console.log(data);
      if(data.MESSAGE.length==0) return false;
      var row = JSON.parse(data.MESSAGE[0].CONTENT);
      $(".banner-section").css("background-image",'url(' + row[0].image[0].src + ')');
      $(".banner-section h2").html( row[0].title[0].text );
      $(".banner-section .btext").html( row[0].title[1].text );
      $(".banner-section .banner-btn").append(`<a href="${row[0].button[0].link}" style="margin-right: 5px;" class="learn">${row[0].button[0].text}</a>` );
      $(".banner-section .banner-btn").append(`<a href="${row[0].button[1].link}" class="view">${row[0].button[1].text}</a>` );
    }

})();
