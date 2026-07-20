(function () {
  var button = document.querySelector('.menu-toggle');
  var menu = document.querySelector('.main-nav');
  if (!button || !menu) return;

  var parentItems = menu.querySelectorAll('.menu-item-has-children');
  for (var i = 0; i < parentItems.length; i++) {
    var item = parentItems[i];
    var link = item.querySelector(':scope > a');
    var submenu = item.querySelector(':scope > .sub-menu');
    if (!link || !submenu) continue;

    var toggle = document.createElement('button');
    toggle.className = 'submenu-toggle';
    toggle.type = 'button';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Abrir submenu de ' + link.textContent.trim());
    item.insertBefore(toggle, submenu);
  }

  button.addEventListener('click', function () {
    var open = menu.classList.toggle('is-open');
    button.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (!open) closeSubmenus(menu);
  });

  menu.addEventListener('click', function (event) {
    var toggle = event.target.closest('.submenu-toggle');
    if (!toggle || !menu.contains(toggle)) return;

    var item = toggle.closest('.menu-item-has-children');
    if (!item) return;

    var open = item.classList.toggle('submenu-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });

  function closeSubmenus(scope) {
    var openItems = scope.querySelectorAll('.submenu-open');
    var toggles = scope.querySelectorAll('.submenu-toggle[aria-expanded="true"]');
    for (var i = 0; i < openItems.length; i++) {
      openItems[i].classList.remove('submenu-open');
    }
    for (var j = 0; j < toggles.length; j++) {
      toggles[j].setAttribute('aria-expanded', 'false');
    }
  }
}());
