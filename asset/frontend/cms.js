(function() {
  'use strict';
  var DokuMe_CMS = function(publicBackend) {
    this.backend = publicBackend;
  };

  /*
  * get dynamic object 205
  */
  DokuMe_CMS.prototype.get205Object = function(itemId,cnd, cb) {
    var _ = this;
    var arr = [];
    if(typeof cnd.position !== 'undefined'){
      arr.push({
        key: 'POSITION',
        operator: 'is',
        value: cnd.position
      });
    }
    if(typeof cnd.type !== 'undefined'){
      arr.push({
        key: 'TYPE',
        operator: 'is',
        value: cnd.type
      });
    }
    if(typeof cnd.name !== 'undefined'){
      arr.push({
        key: 'NAME',
        operator: 'is',
        value: cnd.name
      });
    }
    this.backend.getObject(205, itemId, {
      where: arr
    }, function(data) {
      _.executeCallback(cb, data, 'get205Object');
    });
  };

  /*
  * get cms menu
  */
  DokuMe_CMS.prototype.getMenu = function(cnd,cb) {
    var _ = this;
    var arr = [];
    if(typeof cnd.parent !== 'undefined'){
      arr.push({
        key: 'PARENT',
        operator: 'is',
        value: parseInt(cnd.parent)
      });
    }
    if(typeof cnd.type !== 'undefined'){
      arr.push({
        key: 'TYPE',
        operator: 'is',
        value: cnd.type
      });
    }
    if(typeof cnd.url !== 'undefined'){
      arr.push({
        key: 'URL',
        operator: 'is',
        value: cnd.url
      });
    }
    if(typeof cnd.id !== 'undefined'){
      arr.push({
        key: 'ID',
        operator: 'is',
        value: parseInt(cnd.id)
      });
    }
    backend.getObject(204, null, {
      references: [{
        OBJECT: 'CMS_MENU',
      }],
      where: arr
    }, function(data) {
      _.executeCallback(cb, data, 'getMenu');
    });
  }
  /*
   * check if callback is defined, else console info
   */
  DokuMe_CMS.prototype.executeCallback = function(callback, data, name) {
    if (typeof callback === 'function') {
      callback(data);
    } else {
      console.info('Define callback for ' + name);
    }
  };

  DokuMe_CMS.prototype.encodeString = function( data) {
    return btoa(unescape(encodeURIComponent(data)));
  };

  DokuMe_CMS.prototype.decodeString = function( data) {
    return decodeURIComponent(escape(atob(data)));
  };

  //expose DokuMe_CMS to window
  window.DokuMe_CMS = DokuMe_CMS;
})();
