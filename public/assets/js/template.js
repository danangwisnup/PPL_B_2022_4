var e = {
    init: function () {
        e.fakePwd();
    },
    isVariableDefined: function (el) {
        return typeof !!el && el != "undefined" && el != null;
    },
    getParents: function (el, selector, filter) {
        const result = [];
        const matchesSelector =
            el.matches ||
            el.webkitMatchesSelector ||
            el.mozMatchesSelector ||
            el.msMatchesSelector;

        // match start from parent
        el = el.parentElement;
        while (el && !matchesSelector.call(el, selector)) {
            if (!filter) {
                if (selector) {
                    if (matchesSelector.call(el, selector)) {
                        return result.push(el);
                    }
                } else {
                    result.push(el);
                }
            } else {
                if (matchesSelector.call(el, filter)) {
                    result.push(el);
                }
            }
            el = el.parentElement;
            if (e.isVariableDefined(el)) {
                if (matchesSelector.call(el, selector)) {
                    return el;
                }
            }
        }
        return result;
    },
    getNextSiblings: function (el, selector, filter) {
        let sibs = [];
        let nextElem = el.parentNode.firstChild;
        const matchesSelector =
            el.matches ||
            el.webkitMatchesSelector ||
            el.mozMatchesSelector ||
            el.msMatchesSelector;
        do {
            if (nextElem.nodeType === 3) continue; // ignore text nodes
            if (nextElem === el) continue; // ignore elem of target
            if (nextElem === el.nextElementSibling) {
                if (!filter || filter(el)) {
                    if (selector) {
                        if (matchesSelector.call(nextElem, selector)) {
                            return nextElem;
                        }
                    } else {
                        sibs.push(nextElem);
                    }
                    el = nextElem;
                }
            }
        } while ((nextElem = nextElem.nextSibling));
        return sibs;
    },
    on: function (selectors, type, listener) {
        document.addEventListener("DOMContentLoaded", () => {
            if (!(selectors instanceof HTMLElement) && selectors !== null) {
                selectors = document.querySelector(selectors);
            }
            selectors.addEventListener(type, listener);
        });
    },
    onAll: function (selectors, type, listener) {
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(selectors).forEach((element) => {
                if (type.indexOf(",") > -1) {
                    let types = type.split(",");
                    types.forEach((type) => {
                        element.addEventListener(type, listener);
                    });
                } else {
                    element.addEventListener(type, listener);
                }
            });
        });
    },
    removeClass: function (selectors, className) {
        if (!(selectors instanceof HTMLElement) && selectors !== null) {
            selectors = document.querySelector(selectors);
        }
        if (e.isVariableDefined(selectors)) {
            selectors.removeClass(className);
        }
    },
    removeAllClass: function (selectors, className) {
        if (
            e.isVariableDefined(selectors) &&
            selectors instanceof HTMLElement
        ) {
            document.querySelectorAll(selectors).forEach((element) => {
                element.removeClass(className);
            });
        }
    },
    toggleClass: function (selectors, className) {
        if (!(selectors instanceof HTMLElement) && selectors !== null) {
            selectors = document.querySelector(selectors);
        }
        if (e.isVariableDefined(selectors)) {
            selectors.toggleClass(className);
        }
    },
    toggleAllClass: function (selectors, className) {
        if (
            e.isVariableDefined(selectors) &&
            selectors instanceof HTMLElement
        ) {
            document.querySelectorAll(selectors).forEach((element) => {
                element.toggleClass(className);
            });
        }
    },
    addClass: function (selectors, className) {
        if (!(selectors instanceof HTMLElement) && selectors !== null) {
            selectors = document.querySelector(selectors);
        }
        if (e.isVariableDefined(selectors)) {
            selectors.addClass(className);
        }
    },
    select: function (selectors) {
        return document.querySelector(selectors);
    },
    selectAll: function (selectors) {
        return document.querySelectorAll(selectors);
    },

    // START:Password
    fakePwd: function () {
        if (e.isVariableDefined(e.select(".fakepassword"))) {
            var password = e.select(".fakepassword");
            var toggler = e.select(".fakepasswordicon");

            var showHidePassword = () => {
                if (password.type == "password") {
                    password.setAttribute("type", "text");
                    toggler.classList.add("fa-eye");
                } else {
                    toggler.classList.remove("fa-eye");
                    password.setAttribute("type", "password");
                }
            };

            toggler.addEventListener("click", showHidePassword);
        }
    },
    // END: Password
};
e.init();
