jQuery(document).ready(function () {
    const topLevelLinks = document.querySelectorAll('.menu--dropdown > .menu__item--has-children > .menu__link');

    topLevelLinks.forEach(link => {
        // Add .menu__item--has-focus on focus
        link.addEventListener('focus', function () {
            this.parentElement.classList.add('menu__item--has-focus');
        });

        // Remove .menu__item--has-focus on blur
        const subMenu = link.nextElementSibling;
        const subMenuLinks = subMenu.querySelectorAll('a');
        const lastLinkIndex = subMenuLinks.length - 1;
        const lastLink = subMenuLinks[lastLinkIndex];

        lastLink.addEventListener('blur', function () {
            link.parentElement.classList.remove('menu__item--has-focus');
        });
    });
});