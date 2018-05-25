(function ($) {
  Drupal.alutechBxDocs = {
    toggle: function (id, e) {
      e.preventDefault();
      var a = $('#' + id);
      a.toggle();
    }
  };
}(jQuery));