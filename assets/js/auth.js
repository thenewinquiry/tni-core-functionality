(function($) {
  const BASE_URL = 'https://members.thenewinquiry.com'

  function getCookie(name) {
    var value = '; ' + document.cookie;
    var parts = value.split('; ' + name + '=');
    if (parts.length == 2) return parts.pop().split(';').shift();
  }

  $.ajaxSetup({
    beforeSend: function(xhr, settings) {
      if (settings.type == 'POST' || settings.type == 'PUT' || settings.type == 'DELETE') {
        if (settings.url.startsWith(BASE_URL)) {
          // get the appropriate CSRF token.
          // the refresh is only used for the '/auth/refresh' endpoint.
          var csrf;
          if (settings.url.endsWith('refresh')) {
            csrf = getCookie('csrf_refresh_token');
          } else {
            csrf = getCookie('csrf_access_token');
          }
          xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        }
      }
    }
  });

  function login(email, password, cb) {
    $.ajax(`${BASE_URL}/auth/login`, {
      type: 'POST',
      crossDomain: true,
      xhrFields: {
        withCredentials: true
      },
      data: JSON.stringify({
        email: email,
        password: password
      }),
      contentType: 'application/json',
      success: cb
    });
  }

  function logout(cb) {
    $.ajax(`${BASE_URL}/auth/logout`, {
      type: 'POST',
      crossDomain: true,
      xhrFields: {
        withCredentials: true
      },
      contentType: 'application/json',
      success: cb
    });
  }
})( jQuery );
