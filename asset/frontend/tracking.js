(function () {
    init();

    function init() {
      DM_CMS.get205Object(null,{type:'image_gallery',position:'tracking'},insertBanner);
      DM_CMS.get205Object(null,{type:'slider',position:'tracking',name:'side-content'},insertSideContent);
    }


    function insertSideContent(data){
      if(data.MESSAGE.length==0) return false;
      var row = JSON.parse(data.MESSAGE[0].CONTENT);
      var htmleft = "";
      var htmright = "";

      htmleft +=`<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay1" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[0].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[0].title[0].text}</h5>
                  <p>${row[0].title[1].text}</p>
              </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay2" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[1].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[1].title[0].text}</h5>
                  <p>${row[1].title[1].text}</p>
              </div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay3" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[2].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[2].title[0].text}</h5>
                  <p>${row[2].title[1].text}</p>
              </div>
          </div>`;

      htmright +=`<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay1" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[3].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[3].title[0].text}</h5>
                  <p>${row[3].title[1].text}</p>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay2" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[4].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[4].title[0].text}</h5>
                  <p>${row[4].title[1].text}</p>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay3" data-effect="fadeInUp">
              <div class="icon-wrap">
                  <i class="${row[5].title[2].text}"></i>
              </div>
              <div class="info">
                  <h5 class="title">${row[5].title[0].text}</h5>
                  <p>${row[5].title[1].text}</p>
              </div>
          </div>`;
      $(`#tracking_leftside .row`).html(htmleft);
      $(`#tracking_rightside .row`).html(htmright);
      // console.log(htmright);
    }

    function insertBanner(data){
      console.log(data);
      if(data.MESSAGE.length==0) return false;
      var row = JSON.parse(data.MESSAGE[0].CONTENT);
      var htm = "";
      htm +=`<img src="${row[0].image[0].src}" class="img-responsive phone-white style-dependent" alt="phone white">
      <img src="${row[1].image[0].src}" class="img-responsive phone-black style-dependent" alt="phone black">`;
      $(".app_phn").html(htm);
    }

})();
