var dataJson = [];
var DM_CONFIG = {
  BACKEND_URL: 'https://dokume.net',
  APP_ID: 13,
  SERVER_URL: 'https://dokume.net/backend/src',
  API_KEY: 'RNu17YNkmEyD0ZAYMtb3SG16o0RBRBDWkppVISYjt4z7BFVcyeOklCnlGJuV1y6N',
  PROFILE_ID: 14677,
  FORM_ID: 3,
  plugin_name: 'forms'
};

var backend = new DokuMe_PublicBackend(DM_CONFIG.SERVER_URL, DM_CONFIG.API_KEY, DM_CONFIG.PROFILE_ID);
var DM_CMS = new DokuMe_CMS(backend);
var siteMenu = {top:[],curMenu:null};

initDefault();

function initDefault() {
  DM_CMS.getMenu({type:'top',shared:false},createTopMenu);
}

function createTopMenu(data) {
  if(data.MESSAGE.length==0) return false;
  //data = data.MESSAGE;
  data =  data.MESSAGE.sort(function(a, b) {
          return parseInt(a.ORDER) - parseInt(b.ORDER);
        });
    var htm='<ul class="menu-ul">';
    for (var idx in data) {
        if(data[idx].PARENT==0 && data[idx].TYPE=='top'){
        	var s_menu_htm='';
          var subMenu = data[idx].SUB_MENU.sort(function(a, b) {
                  return parseInt(a.ORDER) - parseInt(b.ORDER);
                });
            if(subMenu.length>0){
                for (var key in subMenu) {
                	if(subMenu[key].TYPE=='top'){
                    s_menu_htm +=`<li ><a href="${base_url}#/${subMenu[key].URL}">${subMenu[key].TITLE}</a></li>`;
                    siteMenu.top.push(subMenu[key]);
                  }
                }

                if(s_menu_htm!=''){
                	htm +=`<li class="dropdown" data-id="${data[idx].ID}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">${data[idx].TITLE} <b class="caret"><i class="fa arrow-down"></i></b></a>
                        <ul class="dropdown-menu" >`;
                    htm += s_menu_htm;
                    htm += `</ul></li>`;
                }else{
                	htm +=`<li data-id="${data[idx].ID}"><a href="${base_url}#/${data[idx].URL}">${data[idx].TITLE}</a></li>`;
                }
            }else{
                htm +=`<li data-id="${data[idx].ID}"><a href="${base_url}${data[idx].URL}">${data[idx].TITLE}</a></li>`;
            }
            siteMenu.top.push(data[idx]);
        }
    }
    htm += `</ul>`;
    $(".dokume_menu").html(htm);
    // DM_CMS.getMenu({type:'right'},prepierRightMenu);
}
