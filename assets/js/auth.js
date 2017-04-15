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

  function login(email, password, cb, onErr) {
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
      success: cb,
      error: onErr
    });
  }

  function logout(cb) {
    cb = cb || $.noop;
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

  $('.js-login').on('click', 'a', function() {
    var self = $(this);
    var modal = $('<div class="login-modal"></div>');
    var form = $(`
      <form>
        <h3>Login</h3>
        <ul class="login-errors"></ul>
        <p>
          <label>Email</label>
          <input type="email" name="email">
        </p>
        <p>
          <label>Password</label>
          <input type="password" name="password">
        </p>
        <input type="submit" value="Login">
      </form>`);
    modal.append(form);
    $('body').append(modal);
    form.on('submit', function(ev) {
      ev.preventDefault();
      var email = form.find('[name=email]').val();
      var password = form.find('[name=password]').val();

      var errs = [];
      var errEl = form.find('.login-errors').empty();
      if (!email) errs.push('Please enter your email.');
      if (!password) errs.push('Please enter your password.');
      if (errs.length > 0) {
        for (var i=0; i<errs.length; i++) {
          errEl.append(`<li>${errs[i]}</li>`);
        }
      } else {
        login(email, password, function() {
          self.parent().removeClass('js-login').addClass('js-logout');
          self.text('Logout');
          form.remove();
        }, function(xhr, status, err) {
          if (xhr.status == 401) {
            errEl.append(`<li>Incorrect email or password.</li>`);
          }
        });
      }
      return false;
    });
  });

  $('.js-logout').on('click', 'a', function() {
    var self = $(this);
    logout(function() {
      self.parent().removeClass('js-logout').addClass('js-login');
      self.text('Login');
    });
  });
})( jQuery );
